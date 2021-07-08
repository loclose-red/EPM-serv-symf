<?php

namespace App\Controller;

use App\Entity\Capteur;
use App\Entity\Equipement;
use App\Entity\Grandeur;
use App\Entity\Mesure;
use App\Entity\PtMesure;
use App\Entity\Site;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RemplirTablesController extends AbstractController
{
    /**
     * @Route("/remplir/tables", name="remplir_tables")
     */
    public function index(): Response
    {

        $entityManager = $this->getDoctrine()->getManager();

        /////////////////////////////////////////////
        //       rempli table grandeur
        /////////////////////////////////////////////

        // $tableauGrandeur[] = ['Pression Pascal', 'Pa'];
        // $tableauGrandeur[] = ['Température Degrés Celsius', 'Deg_C'];
        // foreach ($tableauGrandeur as $untableau) {
        //     $grandeur = new Grandeur();
        //     $grandeur->setGraNom($untableau[0]);
        //     $grandeur->setGraUnite($untableau[1]);
        //     $entityManager->persist($grandeur);
        // }

        /////////////////////////////////////////////
        //       rempli table site
        /////////////////////////////////////////////

        // $tableauSite = ['Rennes', 'Nantes', 'Chanteloup', 'Bourgbarré', 'Noyal'];
        // foreach ($tableauSite as $ville) {
        //     $site = new Site();
        //     $site->setSitVille($ville);
        //     $site->setSitRaisonSociale('Ets_' . $ville);
        //     $site->setSitCPostal(mt_rand(20000, 50000));
        //     $entityManager->persist($site);
        // }


        /////////////////////////////////////////////
        //       test récupération fichier json
        /////////////////////////////////////////////

        // $json = file_get_contents("../src/DataJson/sites.json");
        // $parsed_json = json_decode($json);
        // $untab = $parsed_json->{'des sites'};
        // foreach ($untab as $key => $value) {
        //     dump($value->{'ville'} . $key);
        // }
        // die();

        // dd($untab);

        /////////////////////////////////////////////
        //       remplir equipements pour site Rennes
        /////////////////////////////////////////////

        // récupération de lobjet site de rennes

        $repositorySite = $this->getDoctrine()->getRepository(Site::class);
        $monSiteRennes = $repositorySite->findOneBy([
            'sit_ville' => 'Rennes',
        ]);

        // $json = file_get_contents("../src/DataJson/equipements.json");
        // $parsed_json = json_decode($json);
        // $untab = $parsed_json->{'equipements'};
        // foreach ($untab as $key => $value) {
        //     $equipement = new Equipement();
        //     $equipement->setEquMarque($value->{'marque'});
        //     $equipement->setEquModele($value->{'modele'});
        //     $equipement->setEquSerie($value->{'serie'});
        //     $equipement->setSite($monSiteRennes);


        //     $entityManager->persist($equipement);

        // }


        /////////////////////////////////////////////
        //       remplir points de mesures pour un equipement du site Rennes
        /////////////////////////////////////////////

        //récupération de lobjet d'un equipement (le premier) du site de Rennes
        $repositorySite = $this->getDoctrine()->getRepository(Equipement::class);
        $unEquipementRennes = $repositorySite->findOneBy([
            'site' => $monSiteRennes,
        ]);

        //récupération de lobjet grandeur Deg_C
        $repositoryGrand = $this->getDoctrine()->getRepository(Grandeur::class);
        $grandeurDegC = $repositoryGrand->findOneBy([
            'gra_unite' => 'Deg_C',
        ]);


        // $json = file_get_contents("../src/DataJson/points_mesures.json");
        // $parsed_json = json_decode($json);
        // $untab = $parsed_json->{'points de mesure'};
        // foreach ($untab as $key => $value) {
        //     $ptMesure = new PtMesure();
        //     $ptMesure->setPtMesNom($value->{'nom'});
        //     $ptMesure->setPtMesPosition($value->{'position'});
        //     $ptMesure->setGrandeur($grandeurDegC);
        //     $ptMesure->setEquipement($unEquipementRennes);


        //     $entityManager->persist($ptMesure);
        // }


        /////////////////////////////////////////////
        //       remplir capteurs
        /////////////////////////////////////////////

        // $json = file_get_contents("../src/DataJson/capteurs.json");
        // $parsed_json = json_decode($json);
        // $untab = $parsed_json->{'capteurs'};
        // foreach ($untab as $key => $value) {
        //     $capteur = new Capteur();
        //     $capteur->setGrandeur($grandeurDegC);
        //     $capteur->setCapMarque($value->{'marque'});
        //     $capteur->setCapModele($value->{'modele'});
        //     $capteur->setCapSerie($value->{'serie'});

        //     $entityManager->persist($capteur);
        // }

        ////////////////////////////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////
        //       remplir mesures
        /////////////////////////////////////////////

        //récupération de lobjet du premier capteur trouvé
        $repositorySite = $this->getDoctrine()->getRepository(Capteur::class);
        $unCapteur = $repositorySite->findOneBy([]);

        //récupération de lobjet du premier point de mesure du premier capteur du site Rennes
        $repositoryPtMes = $this->getDoctrine()->getRepository(PtMesure::class);
        $unPtDeMes = $repositoryPtMes->findOneBy([
            'equipement' => $unEquipementRennes,
        ]);

        // $json = file_get_contents("../src/DataJson/mesures.json");
        // $parsed_json = json_decode($json);
        // $untab = $parsed_json->{'mesures'};
        // foreach ($untab as $key => $value) {
        //     $mesure = new Mesure();
        //     $mesure->setGrandeur($grandeurDegC);
        //     $mesure->setMesValeur1($value->{'val1'});
        //     $mesure->setCapteur($unCapteur);

        //     //création d'un objet date avec les string date time du fichier json
        //     //on concatène date et time
        //     $uneDateStr = $value->{'date'} . " " . $value->{'time'};
        //     //création de l'objet datetime
        //     $uneDate = new DateTime();
        //     //on transforme str datetime en timestamp, puis on l'affecte à l'objet datetime
        //     $uneDate->setTimestamp(strtotime($uneDateStr));
        //     $mesure->setMesDate($uneDate);

        //     $mesure->setPtmesure($unPtDeMes);

        //     $entityManager->persist($mesure);
        // }


        // for ($counter = 0; $counter < 10; $counter++) {
        //     $grandeur = new Grandeur();
        //     $grandeur->setGraNom('Mon titre ' . mt_rand());
        //     $grandeur->setContent('Mon contenu' . mt_rand());
        //     $entityManager->persist($grandeur);
        // }

        $entityManager->flush();


        return $this->render('remplir_tables/index.html.twig', [
            'controller_name' => 'RemplirTablesController',
        ]);
    }
}
