<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $trigger = <<<SQL
            CREATE TRIGGER `timeline_reactions_after_insert` AFTER INSERT ON `timeline_reactions`
            FOR EACH ROW
            BEGIN
                UPDATE `timelines`
                SET `total_reaction` = `total_reaction` + 1
                WHERE `id` = NEW.timeline_id;
            END;

            CREATE TRIGGER `timeline_reactions_after_delete` AFTER DELETE ON `timeline_reactions`
            FOR EACH ROW
            BEGIN
                UPDATE `timelines`
                SET `total_reaction` = GREATEST(`total_reactions` - 1, 0)
                WHERE `id` = OLD.timeline_id;
            END;
        SQL;

        DB::unprepared($trigger);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $triggerInsert = 'DROP TRIGGER IF EXISTS `timeline_reactions_after_insert`';
        $triggerDelete = 'DROP TRIGGER IF EXISTS `timeline_reactions_after_delete`';

        DB::unprepared($triggerInsert);
        DB::unprepared($triggerDelete);
    }
};
