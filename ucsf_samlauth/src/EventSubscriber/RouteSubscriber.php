<?php
/**
 * @file
 * Contains \Drupal\ucsf_samlauth\EventSubscriber\RouteSubscriber.
 */

namespace Drupal\ucsf_samlauth\EventSubscriber;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase
{

    /**
     * {@inheritdoc}
     */
    public function alterRoutes(RouteCollection $collection)
    {
       /**
         * ----------------------------------------------------------------
         * Deny access to '/user/password' for anonymous users
         * Allow authenticated users to change their own password
         * Note that the second parameter of setRequirement() is a string.
         * ----------------------------------------------------------------
         */
        if ($route = $collection->get('user.pass'))
        {
            if (!\Drupal::currentUser()->isAuthenticated())
            {
                $route->setRequirement('_access', 'FALSE');
            }
        }
    }
}