<?php
declare(strict_types=1);

namespace App\Docs\C4Model\C4Model\Domain;

use StructurizrPHP\Core\Model\Enterprise;
use StructurizrPHP\Core\Model\Tags;
use StructurizrPHP\Core\View\Configuration\Shape;
use StructurizrPHP\Core\Workspace;

class WorkspaceCreator
{
    public const TAG_PERSON = 'PERSON';
    public const TAG_DB = 'DB';
    public const TAG_CONTAINER = 'CONTAINER';
    public const SOFTWARE_SYSTEM_CART_PRODUCT_API = 'CART_PRODUCT_API';
    public const SOFTWARE_SYSTEM_EXTERNAL = 'EXTERNAL TOOL';
    public const TAG_COMPONENT = 'COMPONENT';
    public const TAG_PIPE = 'PIPE';


    public static function create(): Workspace
    {
        $workspace = new Workspace(
            getenv('STRUCTURIZR_WORKSPACE_ID'),
            'Cart Product API',
            'Krzysztof Surdy Cart Product API'
        );

        $enterprise = new Enterprise('Krzysztof Surdy');
        $workspace->getModel()->setEnterprise($enterprise);
        $styles = $workspace->getViews()->getConfiguration()->getStyles();

        // Styles
        $styles->addElementStyle(Tags::SOFTWARE_SYSTEM)->background('#1268BD')->color('#ffffff');
        $styles->addElementStyle(self::SOFTWARE_SYSTEM_EXTERNAL)->background('#bcc0c3')->color('#ffffff');
        $styles->addElementStyle(self::SOFTWARE_SYSTEM_CART_PRODUCT_API)->background('#999999')->color('#ffffff');
        $styles->addElementStyle(Tags::PERSON)->background('#08427b')->color('#ffffff')->shape(Shape::person());
        $styles->addElementStyle(self::TAG_PERSON)->color('#ffffff')->background('#7dd2fa');
        $styles->addElementStyle(self::TAG_CONTAINER)->color('#ffffff')->background('#438DD5');
        $styles->addElementStyle(self::TAG_COMPONENT)->color('#ffffff')->background('#85BBF0');
        $styles->addElementStyle(self::TAG_DB)->shape(Shape::cylinder())->color('#ffffff')->background('#438DD5');
        $styles->addElementStyle(self::TAG_PIPE)->shape(Shape::pipe())->color('#ffffff')->background('#438DD5');
        return $workspace;
    }
}
