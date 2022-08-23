<?php

namespace App\Controller;

use App\Entity\Medicament;
use App\Repository\MedicamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Attachment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CommandController extends AbstractController
{
    private $mailer;
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @Route(
     *     path="/api/commandes/ordonnance",
     *     methods={"POST"}
     *     )
     */
    public function add(Request $request, MedicamentRepository $medicamentRepository, EntityManagerInterface $manager, SerializerInterface $serializerInterface, TokenStorageInterface $tokenStorageInterface, \Swift_Mailer $mailer)
    {
        $commandReq = $request->request->all();
        $uploadedfile = $request->files->get('file');
        if ($uploadedfile) {
            $file = $uploadedfile->getRealPath();
            $commandReq['file'] = fopen($file, 'r+');
            $image = $commandReq['file'];
        }
        $commande = $serializerInterface->denormalize($commandReq, 'App\Entity\Command');
        $commande->setDateCommand(new \DateTime('now'))
                ->setOrdonnance($commandReq['file']);


        // dd($commande);

        //->setUser($creator);

    // Envoi par mail
        $body = '<div>
            <h2>Informations du client</h2><br>
            <span>Nom complet: ' . $commande->getNomClient(). '</span><br>
            <span>Téléphone: ' . $commande->getNumeroClient() . '</span><br>
            <span>Adresse: ' . $commande->getAdresse() . '</span><br>
            <h1>Détails de la commande</h1>';
            
        $file = "../public/assets/" . uniqid() . '.png';
        
        file_put_contents($file, $image);
        $path = $file;
        $this->email($body, $path);
        $manager->persist($commande);
        $manager->flush();

        return $this->json($commande, Response:: HTTP_CREATED);
    }
     /**
     * @Route(
     *     path="/api/commandes/ponctuel",
     *     methods={"POST"}
     *     )
     */
    public function addCommand(Request $request, EntityManagerInterface $manager, SerializerInterface $serializerInterface, \Swift_Mailer $mailer)
    {
        $commandReq = $request->getContent();
        $commandTab = $serializerInterface->decode($commandReq,"json");
        //dd($commande);
        $tablibelle = [];
        $tabquantite = [];
        
        $commande = $serializerInterface->denormalize($commandTab, 'App\Entity\CommandPonctuel');
        // dd($commandTab['medicament']);
        foreach ($commandTab['medicament'] as $value) {
            $medoc = $serializerInterface->denormalize($value, 'App\Entity\Medicament');
            array_push($tablibelle, $value['libelle']);
            array_push($tabquantite, $value['quantite']);
        }
        // dd($medoc);
        $commande
            ->setAdresse($commandTab['adresse'])
            ->setNomClient($commandTab['nomClient'])
            ->setNumeroClient($commandTab['numeroClient']);

        // Envoi par mail
        
        $tab = '';
        for ($i=0; $i < count($tablibelle); $i++) { 
            $tab = $tab.'<tr><td>'.$tablibelle[$i].'</td><td>'.$tabquantite[$i].'</td></tr>';
        }
        
        $body = '<div>
            <h2>Informations du client</h2><br>
            <span>Nom complet: ' . $commandTab['nomClient'] . '</span><br>
            <span>Téléphone: ' . $commandTab['numeroClient'] . '</span><br>
            <span>Adresse: ' . $commandTab['adresse'] . '</span><br>
            <h2>Détails de la commande</h2>
            <table>
                <tr>
                    <th>Médicament</th>
                    <th>Quantité</th>
                </tr>
                    ' .$tab.'
                </span>
            </table>';
        $path = null;
        $this->email($body, $path);

        $manager->persist($commande);
        $manager->flush();

        return $this->json($commande, Response:: HTTP_CREATED);
    }
    // Fonction qui envoie les mails
    private function email($body, $path)
    {
        $message = (new \Swift_Message('Safe'))
            ->setFrom('massndongo86@gmail.com')
            ->setTo('massndongo86@gmail.com')

            ->setBody($body, 'text/html');
        if ($path) {
            $message->embed(\Swift_Image::fromPath($path));
        }
        $this->mailer->send($message);
    }
}
