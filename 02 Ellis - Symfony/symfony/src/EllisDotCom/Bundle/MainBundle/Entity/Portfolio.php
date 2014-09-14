<?php
namespace EllisDotCom\Bundle\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// this enitiy manages the fields of the portfolio table...

/**
 * Portfolio
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="Portfolio")
 *
 * @author pete wond
 */
class Portfolio
{
    // join to Categories table..
    /**
     * @ORM\ManyToOne(targetEntity="Categories", inversedBy="portfolio")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

    // Portfolio table info below...
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

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
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer")
     */
    private $category_id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="text")
     */    
    private $tags;

    /**
     * @var string
     *
     * @ORM\Column(name="aspect", type="text")
     */    
    private $aspect;

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
     * Set title
     *
     * @param string $title
     * @return Portfolio
     */
    public function setTitle($title)
    {
        $this->title = $title;

        $this->setSlug($title);
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
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
     * @return Portfolio
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
     * Set category_id
     *
     * @param integer $categoryId
     * @return Portfolio
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;
    
        return $this;
    }

    /**
     * Get category_id
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Portfolio
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Portfolio
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    
        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set aspect
     *
     * @param string $aspect
     * @return Portfolio
     */
    public function setAspect($aspect)
    {
        $this->aspect = $aspect;
    
        return $this;
    }

    /**
     * Get aspect
     *
     * @return string 
     */
    public function getAspect()
    {
        return $this->aspect;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Portfolio
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
     * @return Portfolio
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

    // special functions created by join to categories table...

    /**
     * Set category
     *
     * @param \EllisDotCom\Bundle\MainBundle\Entity\Categories $category
     * @return Portfolio
     */
    public function setCategory(\EllisDotCom\Bundle\MainBundle\Entity\Categories $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \EllisDotCom\Bundle\MainBundle\Entity\Categories 
     */
    public function getCategory()
    {
        return $this->category;
    }
}