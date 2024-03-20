<?php

declare(strict_types=1);

namespace iSrDxv\CitizenTest;

use nooby\citizen\CitizenLibrary;
use nooby\citizen\entity\Citizen;

use pocketmine\player\Player;
use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase
{
    private CitizenLibrary $citizen;

    function onEnable(): void
    {
        $this->citizen = CitizenLibrary::create($this);
        $this->getLogger()->info("Plugin Enabled");
    }

    function onCommand(Player|CommandSender $sender, Command $command, string $label, array $args): bool
    {
        if ($command->getName() === "npc") {
            $factory = $this->citizen->getFactory();

            $citizen = Citizen::create($sender);
            $citizen->setScale(2.5);

            $tagEditor = $citizen->getTagEditor();
            $tagEditor->putLine("HardCore Factions");
            $tagEditor->putLine("Players: " . count($this->getServer()->getOnlinePlayers()));
            $tagEditor->putLine("Click to join");
            
            $citizen->spawnTo($sender);

            $factory->add($citizen);
            $sender?->sendMessage("NPC Loaded");
            return true;
        }
    }
}
