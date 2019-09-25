<?php

namespace Xigen\ImageCache\Console\Command;

use Magento\Framework\App\Area;
use Symfony\Component\Console\Command\Command;
use Magento\Catalog\Model\Product\Image;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Magento\Framework\App\ObjectManager;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\State;

/**
 * Class Clean
 * @package Xigen\ImageCache\Console\Command
 */
class Clean extends Command
{
    /**
     * @var State
     */
    protected $state;

    /**
     * @var ObjectManager
     */
    protected $_objectManager;

    /**
     * Clean constructor.
     * @param State $state
     */
    public function __construct(
        State $state
    ) {
        $this->state = $state;
        $this->_objectManager = ObjectManager::getInstance();
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->state->setAreaCode(Area::AREA_ADMINHTML);
        $this->_objectManager->create(Image::class)->clearCache();
        $output->writeln("Cleaned image cache");
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("cache:image:clean");
        $this->setDescription("Clean image cache");
        parent::configure();
    }
}
