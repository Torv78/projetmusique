<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Album;
use App\Entity\Style;
use App\Entity\Artiste;
use App\Entity\Morceau;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create("fr_FR");

        $lesstyles = $this->chargefichier("style.csv");

        foreach ($lesstyles as $value) {
            // Vérifier si la ligne est bien formatée
            if (is_array($value) && count($value) >= 2) {
                $style = new Style();
                $style->setId(intval($value[0]))
                        ->setNom($value[1])
                        ->setCouleur($faker->safeColorName());
                $manager->persist($style);
                $this->addReference("style" . $style->getId(), $style);
            }
        }






        // Charger les artistes
        $lesartistes = $this->chargefichier("artiste.csv");

        $genres = ["men", "women"];
        foreach ($lesartistes as $value) {
            // Vérifier si la ligne est bien formatée
            if (is_array($value) && count($value) >= 3) {
                $artiste = new Artiste();
                $artiste->setId(intval($value[0]))
                        ->setNom($value[1])
                        ->setDescription("<p>" . join("</p><p>", $faker->paragraphs(5)) . "</p>")
                        ->setSite($faker->url())
                        ->setImage('https://randomuser.me/api/portraits/' . $faker->randomElement($genres) . "/" . mt_rand(1, 99) . ".jpg")
                        ->setType($value[2]);

                $manager->persist($artiste);
                $this->addReference("artiste" . $artiste->getId(), $artiste);
            }
        }

        // Charger les albums
        $lesalbums = $this->chargefichier("album.csv");
        foreach ($lesalbums as $value) {
            // Vérifier si la ligne est bien formatée
            if (is_array($value) && count($value) >= 5) {
                $album = new Album();
                $album->setId(intval($value[0]))
                      ->setNom($value[1])
                      ->setDate(intval($value[2]))
                      ->setImage($faker->imageUrl(640, 480))
                      ->addStyle($this->getReference("style" . $value[3]))
                      ->setArtiste($this->getReference("artiste" . $value[4]));

                $manager->persist($album);
                $this->addReference("album" . $album->getId(), $album);
            }
        }

        // Charger les morceaux
        $lesmorceaux = $this->chargefichier("morceau.csv");
        foreach ($lesmorceaux as $value) {
            // Vérifier si la ligne est bien formatée
            if (is_array($value) && count($value) >= 4) {
                $morceau = new Morceau();
                $morceau->setId(intval($value[0]))
                        ->setTitre($value[2])
                        ->setAlbum($this->getReference("album" . $value[1]))
                        ->setDuree(date("i:s", $value[3]));

                $manager->persist($morceau);
                $this->addReference("morceau" . $morceau->getId(), $morceau);
            }
        }

        // Sauvegarder les entités en base de données
        $manager->flush();
    }

    // Fonction pour charger les fichiers CSV
    public function chargefichier($fichier)
    {
        $data = [];
        $fichiercsv = fopen(__DIR__ . "/" . $fichier, "r");
        while (($ligne = fgetcsv($fichiercsv)) !== false) {
            if (!empty($ligne)) {
                $data[] = $ligne;
            }
        }
        fclose($fichiercsv);
        return $data;
    }
}
