<?php
/**
 * Warring: Есть немного маленьких шуток, что, к сожалению, при чтении вызовет меньше скуки, чем обычно.
 */
namespace AdultLife;

class MyResume extends BanalResume implements IHopelessness
{

    const IM_TIRED_OF_ALL_THIS_SHIT_AND_ME_LEFT_2_DAYS_UNTIL_RETIREMENT = 60;

    public function name()
    {
        return 'Никита';
    }

    public function age()
    {
        return IM_TIRED_OF_ALL_THIS_SHIT_AND_ME_LEFT_2_DAYS_UNTIL_RETIREMENT - 35;
    }

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
        'https://github.com/jlipinio/MVC-test' => 'Свой велосипед MVC Framework  - сделал для резюме, для демонстрирования начальные знания PHP, MVC и PHPUnit. Вдохновлялся Symfony, Kohana и Yii.',
        'Разное' => array(
            'Делал всякие мелочи: Установка CMS-ок, копирование/правка дизайна, установка/редактирования плагинов, приложения для VK.',
            'Взламывал Пентагон. Ничего необычного, все так делали!? Но! Меня, меня взламывал... Хотя выяснить, сколько нас всего прилетело на землю.'
        )
    );

    public $test = array(
        'http://www.quizful.net/user/jlipinio' => 'Хорошие тесты, нехорошие результаты :)'
    );

    private function goals_of_work()
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

} 