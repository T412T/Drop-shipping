<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    private $file; //correspond au fichiers envoyés dans le formulaire, il n'a pas besoin d'être mappé//

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registerDate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?int
    {
        return $this->user;
    }

    public function setUser(int $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getRegisterDate(): ?\DateTimeInterface
    {
        return $this->registerDate;
    }

    public function setRegisterDate(\DateTimeInterface $registerDate): self
    {
        $this->registerDate = $registerDate;

        return $this;
    }

    public function getFile(){
        return $this -> file;
    }

    public function setFile(UploadedFile $file){
        $this -> file = $file;
        return $this;
    }

    public function uploadFile(){
        $name = $this -> file -> getClientOriginalName();
        $newName = $this -> renameFile($name);
        //Enregistrement de la photo en BDD//
        $this -> image = $newName;
        //Enregister la photo sur le serveur//
        $this -> file -> move($this -> dirPhoto(), $newName);

    }

    public function removeFile(){
        if(file_exists($this -> dirPhoto() . $this -> image)){
            unlink($this -> dirPhoto() . $this -> image);

        }
    }

    public function renameFile($name){
        return 'photo_' . time() . '_' . rand(1, 99999) . '_' . $name;
        //chat.jpg deviet photo 15800000000_45239_chat.jpg
    }

    public function dirPhoto(){
        return __DIR__ . '/../../public/photo/';

    }
}
