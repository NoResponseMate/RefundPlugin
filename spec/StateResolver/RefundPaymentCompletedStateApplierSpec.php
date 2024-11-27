<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Sylius Sp. z o.o.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\Sylius\RefundPlugin\StateResolver;

use Doctrine\ORM\EntityManagerInterface;
use PhpSpec\ObjectBehavior;
use Sylius\Abstraction\StateMachine\StateMachineInterface;
use Sylius\RefundPlugin\Entity\RefundPaymentInterface;
use Sylius\RefundPlugin\StateResolver\RefundPaymentCompletedStateApplier;
use Sylius\RefundPlugin\StateResolver\RefundPaymentCompletedStateApplierInterface;
use Sylius\RefundPlugin\StateResolver\RefundPaymentTransitions;

final class RefundPaymentCompletedStateApplierSpec extends ObjectBehavior
{
    function let(StateMachineInterface $stateMachineFactory, EntityManagerInterface $refundPaymentManager): void
    {
        $this->beConstructedWith($stateMachineFactory, $refundPaymentManager);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(RefundPaymentCompletedStateApplier::class);
    }

    function it_implements_refund_payment_completed_state_applier_interface(): void
    {
        $this->shouldImplement(RefundPaymentCompletedStateApplierInterface::class);
    }

    function it_applies_complete_transition_on_refund_payment(
        StateMachineInterface $stateMachine,
        EntityManagerInterface $refundPaymentManager,
        RefundPaymentInterface $refundPayment,
    ): void {
        $this->beConstructedWith($stateMachine, $refundPaymentManager);

        $stateMachine
            ->apply($refundPayment, RefundPaymentTransitions::GRAPH, RefundPaymentTransitions::TRANSITION_COMPLETE)
            ->shouldBeCalled()
        ;

        $refundPaymentManager->flush()->shouldBeCalled();

        $this->apply($refundPayment);
    }

    function it_uses_winzou_state_machine_if_abstraction_not_passed_to_apply_complete_transition_on_refund_payment(
        StateMachineInterface $stateMachineFactory,
        EntityManagerInterface $refundPaymentManager,
        RefundPaymentInterface $refundPayment,
    ): void {
        $stateMachineFactory->apply($refundPayment, RefundPaymentTransitions::GRAPH, RefundPaymentTransitions::TRANSITION_COMPLETE)->shouldBeCalled();

        $refundPaymentManager->flush()->shouldBeCalled();

        $this->apply($refundPayment);
    }
}
