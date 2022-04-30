<?php

namespace App\Entity;

use App\Repository\PostRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $mini_title;

    #[ORM\Column(type: 'string', length: 255)]
    private $One_word_pov;

    #[ORM\Column(type: 'integer')]
    private $mark;

    #[ORM\Column(type: 'string', length: 255)]
    private $location;

    #[ORM\Column(type: 'string', length: 255)]
    private $review_article;

    #[ORM\Column(type: 'datetime_immutable', options: ["default" => "CURRENT_TIMESTAMP"])]
    private $createdAt;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMiniTitle(): ?string
    {
        return $this->mini_title;
    }

    public function setMiniTitle(string $mini_title): self
    {
        $this->mini_title = $mini_title;

        return $this;
    }

    public function getOneWordPov(): ?string
    {
        return $this->One_word_pov;
    }

    public function setOneWordPov(string $One_word_pov): self
    {
        $this->One_word_pov = $One_word_pov;

        return $this;
    }

    public function getMark(): ?int
    {
        return $this->mark;
    }

    public function setMark(int $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getReviewArticle(): ?string
    {
        return $this->review_article;
    }

    public function setReviewArticle(string $review_article): self
    {
        $this->review_article = $review_article;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateTimestamps(){
        if($this->getCreatedAt()===null){
            $this->setCreatedAt(new \DateTimeImmutable());
        }
         $this->setUpdatedAt(new \DateTimeImmutable());
    }
}
