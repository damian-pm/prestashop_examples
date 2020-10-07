<?php

namespace PrestaShop\Module\CustomConsole\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Configuration;

class CreateEntityCommand extends Command
{
    private $content = [];
    private $fields = [];
    private $breakAsking = false;
    private $dir = 'src/PrestaShopBundle/Entity';
    private $namespace = 'PrestaShopBundle\Entity';

    protected function configure()
    {
        $this->setName('create:entity');
        $this->setDescription('Create new entity. Configuration you can find in module manager (Admin panel). Module "customconsole"');

        $this->addArgument('dir', InputArgument::OPTIONAL, 'Path where should be created new entity');
        $this->addArgument('namespace', InputArgument::OPTIONAL, 'Namespace for new entity');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir                = Configuration::get('CUSTOM_CONSOLE_ENTITY_PATH') ?: $this->dir;
        $namespace          = Configuration::get('CUSTOM_CONSOLE_ENTITY_NAMESPACE') ?: $this->namespace;

        $entityName       = '';
        $filesystem       = new Filesystem();
        $this->content[]  = "<?php";
        $this->content[]  = "namespace ".$namespace.";";
        $this->content[]  = "use Doctrine\ORM\Mapping as ORM; ";
        $this->content[]  = "\n/**";
        $this->content[]  = " * @ORM\Table()";
        $this->content[]  = " * @ORM\Entity()";
        $this->content[]  = " */";

        $entityName       = $this->makeQuestion($input, $output, 'Enter new entity name [empty exit]:');
        $entityPath       = $dir.'/'.$entityName.'.php';

        if ($this->breakAsking) {
            $output->write("\nCreating entity aborted!\n");
            return;
        }
        if ($filesystem->exists($entityPath)) {
            $output->write("\nEntity exists - exit!\n");
            return;
        }

        $this->content[]    = "class ".$entityName." {";
        $this->generateDefaultIdPrimary();
        $this->generateVars($input, $output);
        $this->generateGetsSets();
        $this->content[]    = "}";
        $this->createAndWriteFile($filesystem, $dir, $entityPath);
        $output->write("\nSuccess created entity! \nPath file: ".$entityPath."\n");

    }
    /**
     * Undocumented function
     *
     * @param Filesystem $filesystem
     * @param [type] $dir
     * @param [type] $entityPath
     * @return void
     */
    public function createAndWriteFile(Filesystem $filesystem, $dir, $entityPath){
        try {
            $filesystem->mkdir($dir);
            $filesystem->touch($entityPath);
            $filesystem->dumpFile($entityPath, implode("\n", $this->content));

        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while creating your directory at ".$exception->getPath();
        }
    }
    /**
     * Undocumented function
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    public function generateVars(InputInterface $input, OutputInterface $output){
        
        for (;1>0;) {
            $length             = false;
            $joinEntity         = false;
            $entityReference    = false;
            $nullable           = false;
            $name               = $this->makeQuestion($input, $output, "\nNew property name [empty exit]:");
            if ($this->breakAsking) break;
            $name               = lcfirst( str_replace("_", "", ucwords($name, " /_")) );
            $output->write("Types: integer, string, date, text, ManyToOne, OneToMany, ManyToMany, etc.\n");

            $type               = $this->makeQuestion($input, $output, 'Field type? [empty exit]:');
            if ($this->breakAsking) break;
            $type               = $type === 'str' ? 'string' : $type;
            $type               = $type === 'int' ? 'integer' : $type;
            
            if ($type == "string") {
                $length     = $this->makeQuestion($input, $output, 'What length? [255]:');
                $length     = $length ?: '255';
            }

            if (in_array($type, ['ManyToOne', 'OneToOne', 'ManyToMany'])) {
                $joinEntity         = $this->makeQuestion($input, $output, 'Write entity name to join:');
                $entityReference    = $this->makeQuestion($input, $output, 'What column reference from '.$joinEntity.'?:');
                if ($this->breakAsking) break;
            } else {
                $nullable        = $this->makeQuestion($input, $output, 'Can this field be null in the database [true/false]? [true]:');
                $nullable        = $nullable ?: 'true';    
            }

            $this->content[]    = $this->generateType($name, $type, $length, $nullable, $joinEntity, $entityReference);
            $this->breakAsking  = false;
            $this->fields[]     = $name;

            $output->write("\nColumn added!\n");

        }
    }
    public function generateGetsSets(){
        foreach ($this->fields as $field) {
            // $field = lcfirst( str_replace("_", "", ucwords($field, " /_")) );

            $this->content[] = "\npublic function get".ucfirst($field).'() {';
            $this->content[] = "\t".'return $this->'.$field.";";
            $this->content[] = '}';

            $this->content[] = "\npublic function set".ucfirst($field).'($'.$field.') {';
            $this->content[] = "\t".'$this->'.$field.' = $'.$field.';';
            $this->content[] = "\t".'return $this;';
            $this->content[] = '}';
        }
    }
    /**
     * Undocumented function
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param [type] $text
     * @return void
     */
    public function makeQuestion(InputInterface $input, OutputInterface $output, $text) {
        $question   = new Question($text);
        $helper     = $this->getHelper('question');
        $answer     = $helper->ask($input, $output, $question);
        if ($answer == '') {
            $this->breakAsking = true;
        }
        return $answer;
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function generateDefaultIdPrimary(){
        $this->content[] = "/**";
        $this->content[] = " * @ORM\Id";
        $this->content[] = ' * @ORM\GeneratedValue(strategy="AUTO")';
        $this->content[] = ' * @ORM\Column(name="id", type="integer")';
        $this->content[] = " */";
        $this->content[] = ' private $id;';
    }
    /**
     * Undocumented function
     *
     * @param [type] $name
     * @param [type] $type
     * @param [type] $length
     * @param [type] $nullable
     * @param [type] $joinEntity
     * @param [type] $entityReference
     * @return void
     */
    public function generateType($name, $type, $length, $nullable, $joinEntity , $entityReference){
        $this->content[] = "/**";
        $this->content[] = " * @var ".$type;
        if ($length != '') {
            $length = ', length='.$length;
        }
        if ($joinEntity) {
            $this->content[] = ' * @'.$type.'(targetEntity="'.$joinEntity.'")';
            $this->content[] = ' * @JoinColumn(name="'.$entityReference.'", referencedColumnName="'.$entityReference.'", nullable=false)';
        } else {
            $this->content[] = ' * @ORM\Column(type="'.$type.'"'.$length.', nullable='.$nullable.')';
        }
        $this->content[] = " */";
        $this->content[] = 'private $'.$name.';';
    }
}