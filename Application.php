<?php

namespace App;

use Symfony\Component\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:buy',
    description: 'Buy some items with this app'
)]

final class Application extends Command\Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('item', InputArgument::REQUIRED)
            ->addArgument('coins',InputArgument::IS_ARRAY);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $item = $input->getArgument('item');
        $coins = $input->getArgument('coins');

        $priceA = '63';
        $priceB = '135';
        $priceC = '213';

        /** @var array $coins */
        $coins = array_sum($coins);

//        $coins = ['1', '2', '5', '10', '25', '50'];

//        foreach ($coins as $coin) {
//            echo $coin . ' ';
//
//            if ($coin !== '1' &&  $coin !== '2' && $coin !== '5' && $coin !== '10' && $coin !== '25' && $coin !== '50') {
//                echo 'Невірна монета';
//            }
//        }

        if ($item !== 'A' && $item !== 'B' && $item !== 'C') {
            $io->error('Item '.$item.' does not exists');
            die();
        }

        if (!$coins) {
            $io->error('Please put some coins');
            die();
        }


        /** @var int $coins */
        if ($item === 'A' && $coins < $priceA) {
            $io->error('Not enough money for buying A');
            die();
        } elseif ($item === 'A') {
            $confirm = sprintf(
                'Success! You bought A. Your odd money '. $coins - $priceA);
            $io->success($confirm);
        }

        if ($item === 'B' && $coins < $priceB) {
            $io->error('Not enough money for buying B');
            die();
        } elseif ($item === 'B') {
            $confirm = sprintf('Success! You bought B. Your odd money '. $coins - $priceB);
            $io->success($confirm);
        }

        if ($item === 'C' && $coins < $priceC) {
            $io->error('Not enough money for buying C');
            die();
        } elseif ($item === 'C') {
            $confirm = sprintf('Success! You bought C. Your odd money '. $coins - $priceC);
            $io->success($confirm);
        }

        return Command\Command::SUCCESS;
    }
}
