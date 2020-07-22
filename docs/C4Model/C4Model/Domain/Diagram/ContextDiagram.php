<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Domain\Diagram;

use App\Docs\C4Model\C4Model\Domain\CartProductApiWorkspace;
use App\Docs\C4Model\C4Model\Domain\TechnologyInterface;
use App\Docs\C4Model\C4Model\Domain\WorkspaceCreator;
use StructurizrPHP\Core\Model\Location;
use StructurizrPHP\Core\Model\StaticStructureElement;
use StructurizrPHP\Core\View\StaticView;

class ContextDiagram implements Diagram
{
    private CartProductApiWorkspace $workspace;

    public function __construct(CartProductApiWorkspace $workspace)
    {
        $this->workspace = $workspace;
    }

    public function generate(): void
    {
        $user = $this->workspace->addPerson(
            'User',
            'API user',
            Location::internal()
        );

        $softwareSystem = $this->workspace->addSoftwareSystem(
            'Cart Product API',
            'Allows users to operate products and carts',
            Location::internal()
        );


        $api = $softwareSystem->addContainer('API', 'API', 'PHP - Symfony 5');
        $api->addTags(WorkspaceCreator::TAG_CONTAINER);
        $this->workspace->addContainerId('API', $api->id());

        $user->usesSoftwareSystem(
            $softwareSystem,
            'uses'
        );

        $db = $softwareSystem->addContainer(
            'Database',
            'Stores information about products',
            'MySQL'
        );
        $db->addTags(WorkspaceCreator::TAG_DB, WorkspaceCreator::TAG_CONTAINER);
        $this->workspace->addContainerId('Database', $db->id());

        $tmpDB = $softwareSystem->addContainer(
            'TMP Database',
            'Stores information about carts',
            'Redis'
        );
        $tmpDB->addTags(WorkspaceCreator::TAG_DB, WorkspaceCreator::TAG_CONTAINER);
        $this->workspace->addContainerId('TMP Database', $tmpDB->id());

        $user->usesContainer($api, 'sends request', TechnologyInterface::HTTP);
        $api->usesContainer($db, 'reads and writes');
        $api->usesContainer($tmpDB, 'reads and writes');

//        $cartController = $api->addComponent(
//            'Cart Controller',
//            'Controller',
//            'Cart controller',
//            TechnologyInterface::CONTROLLER
//        );

        $systemContainerView = $this->create($softwareSystem);
        $systemContainerView->addPerson($user);

        $systemContainerView->addElement($db);
        $systemContainerView->addElement($tmpDB);
        $systemContainerView->addElement($api);

    }

    public function create(StaticStructureElement $element): StaticView
    {
        $contextView = $this->workspace->createContextView(
            $element,
            'APIContext',
            'API Context Diagram'
        );

        $contextView->addAllElements();
        return $contextView;
    }

}
