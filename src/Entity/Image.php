<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @Vich\Uploadable
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageName;
    
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="image", fileNameProperty="imageName")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $posted_at;

    /**
     * @ORM\Column(type="array")
     */
    private $hashtags = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imageFile instanceof UploadedFile) {
            $this->posted_at = new \DateTime('now');
        }
    }

    public function getPostedAt(): ?\DateTimeInterface
    {
        return $this->posted_at;
    }

    public function setPostedAt(\DateTimeInterface $posted_at): self
    {
        $this->posted_at = $posted_at;

        return $this;
    }

    public function getHashtags(): ?array
    {
        return $this->hashtags;
    }

    public function setHashtags(array $hashtags): self
    {
        $this->hashtags = $hashtags;

        return $this;
    }
}
