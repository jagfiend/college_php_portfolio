<?php
namespace EllisDotCom\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

// this enitiy manages the fields of the categories table...

/**
 * Categories
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="Categories")
 *
 * @author pete wond
 */
class Categories
{
    // Join with Portfolio table...
    /**
     * @ORM\OneToMany(targetEntity="Portfolio", mappedBy="category")
     */
    protected $portfolio;

    public function __construct()
    {
        $this->portfolio = new ArrayCollection();
    }

    // Categories table setup below...
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Categories
     */
    public function setCategory($category)
    {
        $this->category = $category;

        $this->setSlug($category);
    
        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Portfolio
     */
    public function setSlug($slug)
    {
        // Remove accents from characters
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $slug);
        // Everything lowercase
        $slug = strtolower($slug);
        // Replace all non-word characters by dashes
        $slug = preg_replace("/\W/", "-", $slug);
        // Replace double dashes by single dashes
        $slug = preg_replace("/-+/", '-', $slug);
        // Trim dashes from the beginning and end of slug
        $slug = trim($slug, '-');

        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return Categories
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    
        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Categories
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Categories
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    // timestamp function...
    
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime(date('Y-m-d H:i:s')));

        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        }
    }

    // special functions created by join to portfolio table...

    /**
     * Add portfolio
     *
     * @param \EllisDotCom\Bundle\MainBundle\Entity\Portfolio $portfolio
     * @return Categories
     */
    public function addPortfolio(\EllisDotCom\Bundle\MainBundle\Entity\Portfolio $portfolio)
    {
        $this->portfolio[] = $portfolio;
    
        return $this;
    }

    /**
     * Remove portfolio
     *
     * @param \EllisDotCom\Bundle\MainBundle\Entity\Portfolio $portfolio
     */
    public function removePortfolio(\EllisDotCom\Bundle\MainBundle\Entity\Portfolio $portfolio)
    {
        $this->portfolio->removeElement($portfolio);
    }

    /**
     * Get portfolio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPortfolio()
    {
        return $this->portfolio;
    }
}