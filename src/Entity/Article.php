<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
 

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $Date;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank
     */
    private $titre;


    /**
     * @ORM\Column(type="string", length=40)
     */
    private $auteur;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $contenu;
    
   /**
   * @ORM\OneToOne(targetEntity="App\Entity\Image", cascade={"persist"})
   */
  private $image;
   /**
   * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", cascade={"persist"})
   */
  private $categories;



    
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->Date;
    }

    public function setDate(string $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }
    public function setImage(?\App\Entity\Image $image = null)
    {
      $this->image=$image;
    }
    /**
     * @return App\Entity\Image 
     */
    public function getImage()
    {
      return $this->image;
    }
    public function __construct()
  {
    
    $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
  }
  /**
    * Add categories
    *
    * @param App\Entity\Categorie $categories
    */
  public function addCategorie(?\App\Entity\Categorie $categorie) 
  {
    // Ici, on utilise l'ArrayCollection vraiment comme un tableau, avec la syntaxe []
    $this->categories[] = $categorie;
  }
  /**
    * Remove categories
    *
    * @param App\Entity\Categorie $categories
    */
  public function removeCategorie(?\App\Entity\Categorie $categorie) 
  {
    
    $this->categories->removeElement($categorie);
  }
  /**
    * Get categories
    *
    * @return Doctrine\Common\Collections\Collection
    */
  public function getCategories() 
  {
    return $this->categories;
  }
    

}
