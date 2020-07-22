<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Domain\Diagram\ComponentDiagrams;

use App\Docs\C4Model\C4Model\Domain\CartProductApiWorkspace;
use App\Docs\C4Model\C4Model\Domain\Diagram\Diagram;
use App\Docs\C4Model\C4Model\Domain\TechnologyInterface;
use App\Docs\C4Model\C4Model\Domain\WorkspaceCreator;
use StructurizrPHP\Core\Model\Container;
use StructurizrPHP\Core\Model\StaticStructureElement;
use StructurizrPHP\Core\View\StaticView;

class ProductComponentDiagram implements Diagram
{
    private CartProductApiWorkspace $workspace;

    public function __construct(CartProductApiWorkspace $workspace)
    {
        $this->workspace = $workspace;
    }

    public function generate(): void
    {
        $user = $this->workspace->getSharedElement('User');

        $mainContainer = $this->workspace->getSharedElement('Cart Product API');
        /** @var Container $api */
        $api = $mainContainer->getContainer($this->workspace->getContainerIdByName('API'));
        /** @var Container $db */
        $db = $mainContainer->getContainer($this->workspace->getContainerIdByName('Database'));
        $productController = $api->addComponent(
            'Product Controller',
            'Controller',
            'Product controller',
            TechnologyInterface::CONTROLLER
        );

        $api->add($productController);


        $productController->addTags(WorkspaceCreator::TAG_COMPONENT);

        $productService = $api->addComponent(
            'Product service',
            'Service',
            'Product service',
            TechnologyInterface::SERVICE
        );

        $productService->addTags(WorkspaceCreator::TAG_COMPONENT);

        $dto = $api->addComponent(
            'DTO',
            'DTO',
            'Data Transfer Object',
            TechnologyInterface::DTO
        );

        $dto->addTags(WorkspaceCreator::TAG_COMPONENT);

        $dtoFactory = $api->addComponent(
            'DTO Factory',
            'Factory',
            'Build Factory',
            TechnologyInterface::FACTORY
        );

        $dtoFactory->addTags(WorkspaceCreator::TAG_COMPONENT);

        $dtoValidator = $api->addComponent(
            'DTO Validator',
            'Validator',
            'Validates data correctness',
            TechnologyInterface::VALIDATOR
        );

        $dtoValidator->addTags(WorkspaceCreator::TAG_COMPONENT);


        $symfonyMessenger = $api->addComponent(
            'Symfony Messenger',
            'Symfony Messenger',
            'Validates data correctness',
            TechnologyInterface::NULL
        );

        $symfonyMessengerHandler = $api->addComponent(
            'Symfony Messenger Handler',
            'Symfony Messenger Handler',
            "Listen for messages on pipe and 'grabs' them",
            TechnologyInterface::NULL
        );

        $symfonyMessengerSubscriber = $api->addComponent(
            'Symfony Messenger Subscriber',
            'Symfony Messenger Subscriber',
            "Subscribes for messages on pipe and 'grabs' them",
            TechnologyInterface::NULL
        );

        $product = $api->addComponent(
            'Product',
            'AggregateModel',
            "Creates events",
            TechnologyInterface::NULL
        );

        $eventStore = $api->addComponent(
            'Event Store',
            'EventStore',
            "Event Store",
            TechnologyInterface::NULL
        );


        $symfonyMessenger->addTags(WorkspaceCreator::TAG_PIPE, WorkspaceCreator::TAG_COMPONENT);

        $user->usesComponent($productController, 'makes API call to', TechnologyInterface::HTTP);
        $productController->usesComponent($dto, 'passes request to DTO', TechnologyInterface::NULL);
        $dto->usesComponent($dtoFactory, 'passes through data do factory using trait', TechnologyInterface::NULL);
        $dtoFactory->usesComponent($dtoValidator, 'makes sure data is valid', TechnologyInterface::NULL);
        $dtoFactory->usesComponent($dto, 'returns build object', TechnologyInterface::NULL);
        $dto->usesComponent($productController, 'returns request DTO', TechnologyInterface::NULL);

        $productController->usesComponent($productService, 'passes DTO request to process further',
            TechnologyInterface::NULL);
        $productService->usesComponent($symfonyMessenger, 'packs data into Command/Query and throws into pipe',
            TechnologyInterface::NULL);
        $symfonyMessenger->usesComponent($symfonyMessengerHandler, 'handler is given message from pipe',
            TechnologyInterface::NULL);

        $symfonyMessengerHandler->usesComponent($product, 'forces state change',
            TechnologyInterface::NULL);

        $product->usesComponent($eventStore, 'sends event to persist',
            TechnologyInterface::NULL);


        $eventStore->usesContainer($db, 'sends serialized json to persist',
            TechnologyInterface::NULL);

        $eventStore->usesComponent($symfonyMessenger, 'sends event to persist',
            TechnologyInterface::NULL);

        $symfonyMessenger->usesComponent($symfonyMessengerSubscriber, 'subscriber is given message from pipe',
            TechnologyInterface::NULL);

        $symfonyMessengerSubscriber->usesContainer($db, 'sends query to database to persist view model',
            TechnologyInterface::NULL);

        $systemComponentView = $this->create($api);
        $systemComponentView->addPerson($user);
        $systemComponentView->addElement($db);
        $systemComponentView->addElement($productController);
        $systemComponentView->addElement($dto);
        $systemComponentView->addElement($dtoFactory);
        $systemComponentView->addElement($dtoValidator);
        $systemComponentView->addElement($productService);
        $systemComponentView->addElement($symfonyMessenger);
        $systemComponentView->addElement($symfonyMessengerHandler);
        $systemComponentView->addElement($symfonyMessengerSubscriber);
        $systemComponentView->addElement($product);
        $systemComponentView->addElement($eventStore);

    }

    public function create(StaticStructureElement $element): StaticView
    {
        $systemComponentView = $this->workspace->createComponentView(
            $element,
            'Product API',
            'Product API Component Diagram'
        );

        return $systemComponentView;
    }

}
