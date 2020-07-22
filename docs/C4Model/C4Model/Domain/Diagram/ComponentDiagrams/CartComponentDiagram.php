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

class CartComponentDiagram implements Diagram
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
        $db = $mainContainer->getContainer($this->workspace->getContainerIdByName('TMP Database'));
        $cartController = $api->addComponent(
            'Cart Controller',
            'Controller',
            'Product controller',
            TechnologyInterface::CONTROLLER
        );
        $cartController->addTags(WorkspaceCreator::TAG_COMPONENT);
        $cartService = $api->addComponent(
            'Cart service',
            'Service',
            'Cart service',
            TechnologyInterface::SERVICE
        );
        $cartService->addTags(WorkspaceCreator::TAG_COMPONENT);

        $cart = $api->addComponent(
            'Cart',
            'AggregateModel',
            "Creates events",
            TechnologyInterface::NULL
        );

        $dto = $api->getComponentWithName('DTO');
        $dtoFactory = $api->getComponentWithName('DTO Factory');
        $dtoValidator = $api->getComponentWithName('DTO Validator');
        $symfonyMessenger = $api->getComponentWithName('Symfony Messenger');
        $symfonyMessengerHandler = $api->getComponentWithName('Symfony Messenger Handler');
        $symfonyMessengerSubscriber = $api->getComponentWithName('Symfony Messenger Subscriber');
        $eventStore = $api->getComponentWithName('Event Store');

        $user->usesComponent($cartController, 'makes API call to', TechnologyInterface::HTTP);
        $cartController->usesComponent($dto, 'passes request to DTO', TechnologyInterface::NULL);
        $dto->usesComponent($cartController, 'returns request DTO', TechnologyInterface::NULL);

        $cartController->usesComponent($cartService, 'passes DTO request to process further',
            TechnologyInterface::NULL);
        $cartService->usesComponent($symfonyMessenger, 'packs data into Command/Query and throws into pipe',
            TechnologyInterface::NULL);

        $symfonyMessengerHandler->usesComponent($cart, 'forces state change',
            TechnologyInterface::NULL);

        $cart->usesComponent($eventStore, 'sends event to persist',
            TechnologyInterface::NULL);

        $eventStore->usesContainer($db, 'sends serialized json to persist',
            TechnologyInterface::NULL);

        $symfonyMessengerSubscriber->usesContainer($db, 'sends query to database to persist view model',
            TechnologyInterface::NULL);

        $systemComponentView = $this->create($api);
        $systemComponentView->addPerson($user);
        $systemComponentView->addElement($db);
        $systemComponentView->addElement($cartController);
        $systemComponentView->addElement($dto);
        $systemComponentView->addElement($dtoFactory);
        $systemComponentView->addElement($dtoValidator);
        $systemComponentView->addElement($cartService);
        $systemComponentView->addElement($symfonyMessenger);
        $systemComponentView->addElement($symfonyMessengerHandler);
        $systemComponentView->addElement($symfonyMessengerSubscriber);
        $systemComponentView->addElement($cart);
        $systemComponentView->addElement($eventStore);

    }

    public function create(StaticStructureElement $element): StaticView
    {
        $systemComponentView = $this->workspace->createComponentView(
            $element,
            'Cart API',
            'Cart API Component Diagram'
        );

        return $systemComponentView;
    }
}
