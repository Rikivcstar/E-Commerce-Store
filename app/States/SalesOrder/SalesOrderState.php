<?php
declare(strict_types=1);

namespace App\States\SalesOrder;


use App\States\SalesOrder\Pending;
use App\States\SalesOrder\Transition\PendingToCancel;
use App\States\SalesOrder\Transition\PendingToProgress;
use App\States\SalesOrder\Transition\ProgressToComplated;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class SalesOrderState extends State
{
    abstract public function label(): string;

    public static function config() : StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Progress::class, PendingToProgress::class)
            ->allowAllTransitions(Pending::class, Cancel::class, PendingToCancel::class)
            ->allowAllTransitions(Progress::class, Completed::class, ProgressToComplated::class);
    }
}
?>
