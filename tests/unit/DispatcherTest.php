<?php

use Hatterhatalom\Engine\Events\CardEvents\CardWasPlayed;
use Hatterhatalom\Engine\Events\Dispatcher;

class DispatcherTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    public function test_if_event_listener_is_registered_and_fired_with_proper_payload()
    {
        $dispatcher = new Dispatcher();

        $payloadValidator = function ($payload) {
            return $payload == 'mia is love';
        };

        $listenerMock = Mockery::mock('stdClass')
            ->shouldReceive('callback')
            ->with(Mockery::on($payloadValidator))
            ->getMock();

        $dispatcher->subscribe(
            \Hatterhatalom\Engine\Events\Event::class,
            [$listenerMock, 'callback']
        );

        $dispatcher->fire(\Hatterhatalom\Engine\Events\Event::class,
            'mia is love');
    }

    public function test_if_event_listener_can_be_unregistered()
    {
        $dispatcher = new Dispatcher();

        $listenerMock = Mockery::mock('stdClass')
            ->shouldNotReceive('yetAnotherCallback')
            ->getMock();

        $dispatcher->subscribe(
            \Hatterhatalom\Engine\Events\Event::class,
            [$listenerMock, 'yetAnotherCallback']
        );

        $dispatcher->unsubscribe(
            \Hatterhatalom\Engine\Events\Event::class,
            [$listenerMock, 'yetAnotherCallback']
        );

        $dispatcher->fire(\Hatterhatalom\Engine\Events\Event::class);
    }

    public function test_if_multiple_listeners_can_be_registered_to_the_same_event()
    {
        $dispatcher = new Dispatcher();

        $payloadValidator = function ($payload) {
            return $payload == 'mia is god';
        };

        $listenerMock = Mockery::mock('stdClass')
            ->shouldReceive('callback1')
            ->with(Mockery::on($payloadValidator))
            ->getMock();

        $anotherMock = Mockery::mock('stdClass')
            ->shouldReceive('callback2')
            ->with(Mockery::on($payloadValidator))
            ->getMock();

        $dispatcher->subscribe(
            CardWasPlayed::class,
            [$listenerMock, 'callback1']
        );

        $dispatcher->subscribe(
            CardWasPlayed::class,
            [$anotherMock, 'callback2']
        );

        $dispatcher->fire(
            \Hatterhatalom\Engine\Events\Event::class,
            'mia is god'
        );
    }

    public function test_if_event_can_be_fired_by_passing_an_event_object_instead_of_class_name()
    {
        $dispatcher = new Dispatcher();

        $payloadValidator = function ($payload) {
            return $payload == 'mia is love';
        };

        $listenerMock = Mockery::mock('stdClass')
            ->shouldReceive('yetAnotherCallback')
            ->with(Mockery::on($payloadValidator))
            ->getMock();

        $dispatcher->subscribe(
            \Hatterhatalom\Engine\Events\Event::class,
            [$listenerMock, 'yetAnotherCallback']
        );

        $dispatcher->fire(new \Hatterhatalom\Engine\Events\Event('mia is love'));
    }
}
