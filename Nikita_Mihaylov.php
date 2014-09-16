<?php
namespace Human;

use FavoritesOfGirl/FavoritesOfGod/Atheist/ParticularlyLazyPerson/Programmer;
use Elit/Successful/Freelancer/Startuper as IUnemployedInLaw;

class Nikita_Mihaylov extends Programmer implements IUnemployedInLaw
{

    const IM_TIRED_OF_ALL_THIS_SHIT_AND_ME_LEFT_2_DAYS_UNTIL_RETIREMENT = 60;

    public $skill = array(
        'PHP' => 'beginner',
        'PHPUnit' => 'beginner',

        'OOP' => array(
            'base' => 'beginner',
            'SOLID' => 'beginner',
            'GRASP' => 'beginner',
        ),

        'MySQL' => 'beginner',
        'Unix' => 'beginner',

        'JS/jQuery' => 'beginner',
        'HTML/CSS' => 'beginner',
        'Flex/ActionScript 3' => 'beginner',

        'Work in crew' => 'as Susanin'
    );

    public $doings = array(
        'Свой велосипед MVC Framework - сделал для резюме, для демонстрирования начальные знания PHP, MVC и PHPUnit. Вдохновлялся Symfony, Kohana и Yii.',
        'Делал всякие мелочи: Установка CMS-ок, копирование/правка дизайна, установка/редактирования плагинов, приложения для VK.',
        'Взламывал Пентагон. Ничего необычного, все так делали!? Но! Меня, меня взламывал... Хотя выяснить, сколько нас всего прилетело на землю.'
    );

    public function name()
    {
        return 'Никита';
    }

    public function age()
    {
        return IM_TIRED_OF_ALL_THIS_SHIT_AND_ME_LEFT_2_DAYS_UNTIL_RETIREMENT - 35;
    }

    public function goals_of_work()
    {
        $skill = $this->skill;
        foreach($skill as $key => $value) {
            if(is_array($value))
                $value = $this->goels($value);
            else
                $value = 'hacker';

            $skill[$key] = $value;
        }

        return $skill;
    }

    public function query($words)
    {
        //smart detected hacking
        $pattern = '#(ну, я же девушка|всем лежать это ограбление|НЕ ПРИСЛОНЯТЬСЯ|ОТКРЫТЬ СДЕСЬ)#i';
        if(preg_match($pattern, $words, $matches))
            return false;

        return parent::query($words);
    }

    public function professional_advice($code)
    {
        if(!$this->execute($code))
            return 'В этом коде есть ошибка, но не исправляй её, она только этого, от тебя, и ждет.' .
                   'Крепись. Собери все свою волю в кулак и иди кодить дальше.' .
                   'Не переживай, на твоем пути еще будет масса ошибок, и гораздо лучше чем эта.';

        return 'Выглядит как идеальный код. А теперь покажи, куда ты спрятал ошибку!?';
    }




} 