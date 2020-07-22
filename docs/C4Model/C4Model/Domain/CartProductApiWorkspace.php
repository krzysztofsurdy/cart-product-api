<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Domain;

use StructurizrPHP\Core\Model\Container;
use StructurizrPHP\Core\Model\Element;
use StructurizrPHP\Core\Model\Location;
use StructurizrPHP\Core\Model\Person;
use StructurizrPHP\Core\Model\SoftwareSystem;
use StructurizrPHP\Core\View\ComponentView;
use StructurizrPHP\Core\View\ContainerView;
use StructurizrPHP\Core\View\PaperSize;
use StructurizrPHP\Core\View\SystemContextView;
use StructurizrPHP\Core\Workspace;

class CartProductApiWorkspace
{
    private Workspace $workspace;
    /** @var Element[] */
    private array $sharedElements;
    private array $containerIdsMapper;

    public function __construct()
    {
        $this->workspace = WorkspaceCreator::create();
    }

    public function get(): Workspace
    {
        return $this->workspace;
    }

    public function addPerson(
        string $name,
        string $description,
        ?Location $location = null,
        ?bool $sharedBetweenViews = false
    ): Person {
        $person = $this->workspace->getModel()->addPerson(
            $name,
            $description,
            $location ?? Location::internal()
        );
        $this->addToShared($person, $sharedBetweenViews);
        return $person;
    }

    public function addSoftwareSystem(
        string $name,
        string $description,
        ?Location $location = null
    ): SoftwareSystem {
        $softwareSystem = $this->workspace->getModel()->addSoftwareSystem(
            $name,
            $description,
            $location ?? Location::internal()
        );

        $this->addToShared($softwareSystem);
        return $softwareSystem;
    }

    public function createContextView(
        SoftwareSystem $softwareSystem,
        string $key,
        string $description
    ): SystemContextView {
        $contextView = $this->workspace->getViews()->createSystemContextView($softwareSystem, $key, $description);
        $contextView->setPaperSize(PaperSize::A4_Landscape());
        return $contextView;
    }

    public function createContainerView(SoftwareSystem $container, string $key, string $description): ContainerView
    {
        $containerView = $this->workspace->getViews()->createContainerView($container, $key, $description);
        $containerView->setPaperSize(PaperSize::A4_Landscape());
        return $containerView;
    }

    public function createComponentView(Container $softwareSystem, string $key, string $description): ComponentView
    {
        $componentView = $this->workspace->getViews()->createComponentView($softwareSystem, $key, $description);
        return $componentView;
    }

    private function addToShared(Element $element): void
    {
        $this->sharedElements[$element->getName()] = $element;
    }

    public function getSharedElement(string $name): ?Element
    {
        return $this->sharedElements[$name] ?? null;
    }

    public function addContainerId(string $name, string $id): void
    {
        $this->containerIdsMapper[$name] = $id;
    }

    public function getContainerIdByName(string $name): string
    {
        return $this->containerIdsMapper[$name];
    }
}
