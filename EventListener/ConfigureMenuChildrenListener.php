<?php

namespace Kunstmaan\AdminBundle\EventListener;

use Kunstmaan\AdminBundle\Event\ConfigureMenuChildrenEvent;
use Symfony\Component\HttpFoundation\Request;

class ConfigureMenuChildrenListener
{

    /**
     * @var Request
     */
    private $request;

    private $em;

    public function __construct(Request $request, $em)
    {
        $this->request = $request;
        $this->em = $em;
    }

    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param ConfigureMenuChildrenEvent $event
     */
    public function onMenuChildrenConfigure(ConfigureMenuChildrenEvent $event)
    {
        if ('Settings' == $event->getMenu()->getName()) {
            $usersMenu = $event->getMenu()->addChild($event->getFactory()->createItem('Users', array('route' => 'KunstmaanAdminBundle_settings_users')));
            $usersMenu->setAttribute('rel', 'Users');
            $usersMenu->setDisplayChildren(false);
            {
                $request = $this->request;
                $currentId = $request->get('id');
                $addMenu = $usersMenu->addChild($event->getFactory()->createItem('Add', array('route' => 'KunstmaanAdminBundle_settings_users_add')));
                $editMenu = $usersMenu->addChild($event->getFactory()->createItem('Edit', array('route' => 'KunstmaanAdminBundle_settings_users_edit', 'routeParameters' => array('id' =>  $currentId))));
                $deleteMenu = $usersMenu->addChild($event->getFactory()->createItem('Delete', array('route' => 'KunstmaanAdminBundle_settings_users_delete', 'routeParameters' => array('id' =>  $currentId))));
            }
            $groupsMenu = $event->getMenu()->addChild($event->getFactory()->createItem('Groups', array('route' => 'KunstmaanAdminBundle_settings_groups')));
            $groupsMenu->setAttribute('rel', 'Groups');
            $groupsMenu->setDisplayChildren(false);
            {
                $request = $this->request;
                $currentId = $request->get('id');
                $addMenu = $groupsMenu->addChild($event->getFactory()->createItem('Add', array('route' => 'KunstmaanAdminBundle_settings_groups_add')));
                $editMenu = $groupsMenu->addChild($event->getFactory()->createItem('Edit', array('route' => 'KunstmaanAdminBundle_settings_groups_edit', 'routeParameters' => array('id' =>  $currentId))));
                $deleteMenu = $groupsMenu->addChild($event->getFactory()->createItem('Delete', array('route' => 'KunstmaanAdminBundle_settings_groups_delete', 'routeParameters' => array('id' =>  $currentId))));
            }
            $rolesMenu = $event->getMenu()->addChild($event->getFactory()->createItem('Roles', array('route' => 'KunstmaanAdminBundle_settings_roles')));
            $rolesMenu->setAttribute('rel', 'Roles');
            $rolesMenu->setDisplayChildren(false);
            {
                $request = $this->request;
                $currentId = $request->get('id');
                $addMenu = $rolesMenu->addChild($event->getFactory()->createItem('Add', array('route' => 'KunstmaanAdminBundle_settings_roles_add')));
                $editMenu = $rolesMenu->addChild($event->getFactory()->createItem('Edit', array('route' => 'KunstmaanAdminBundle_settings_roles_edit', 'routeParameters' => array('id' =>  $currentId))));
                $deleteMenu = $rolesMenu->addChild($event->getFactory()->createItem('Delete', array('route' => 'KunstmaanAdminBundle_settings_roles_delete', 'routeParameters' => array('id' =>  $currentId))));
            }
        }
    }
}