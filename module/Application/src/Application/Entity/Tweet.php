<?php
/**
 * File contains class Tweet
 *
 * @author ma4eto <eddiespb@gmail.com>
 * @since  18.10.2015
 */

namespace Application\Entity;

use DateTime;
use Doctrine\ORM\Mapping;
use InvalidArgumentException;

/**
 * Class Tweet
 *
 * @package Application\Entity
 * @author  ma4eto <eddiespb@gmail.com>
 * @since   18.10.2015
 *
 * @Mapping\Entity
 * @Mapping\Table(name="tweets")
 */
class Tweet
{
    /**
     * @Mapping\Id
     * @Mapping\GeneratedValue(strategy="AUTO")
     * @Mapping\Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @Mapping\Column(type="string")
     *
     * @var string
     */
    protected $avatar;

    /**
     * @Mapping\Column(type="string")
     *
     * @var string
     */
    protected $text;

    /**
     * @Mapping\Column(type="datetime")
     *
     * @var DateTime
     */
    protected $date;

    public function __construct()
    {
        $this->date = new DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     *
     * @return Tweet
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     *
     * @return Tweet
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     *
     * @return Tweet
     */
    public function setDate($date)
    {
        if (is_string($date)) {
            $date = new DateTime($date);
        }

        if (!$date instanceof DateTime) {
            throw new InvalidArgumentException(
                sprintf(
                    'Instance of DateTime or string expected, got `%s`',
                    is_object($date) ? get_class($date) : gettype($date)
                )
            );
        }

        $this->date = $date;

        return $this;
    }
}