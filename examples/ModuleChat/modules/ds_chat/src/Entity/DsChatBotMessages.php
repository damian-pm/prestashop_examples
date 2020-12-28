<?php
namespace PrestaShop\Module\DSChat\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shop.
 *
 * @ORM\Table(
 *  indexes={@ORM\Index(name="key", columns={"domain"})},
 * )
 * @ORM\Entity(repositoryClass="PrestaShop\Module\DSChat\Repository\ChatBotMessagesRepository")
 */
class DsChatBotMessages
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="question", type="string", length=255)
     */
    private $question;
    /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=255)
     */
    private $answer;

    /**
     * Get the value of question
     *
     * @return  string
     */ 
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set the value of question
     *
     * @param  string  $question
     *
     * @return  self
     */ 
    public function setQuestion(string $question)
    {
        $this->question = $question;

        return $this;
    }

    /**
     * Get the value of answer
     *
     * @return  string
     */ 
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set the value of answer
     *
     * @param  string  $answer
     *
     * @return  self
     */ 
    public function setAnswer(string $answer)
    {
        $this->answer = $answer;

        return $this;
    }
}