<?php
/**
 * Waring: Есть немного маленьких шуток, что, к сожалению, при чтении вызовет меньше скуки, чем обычно.
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
        return self::IM_TIRED_OF_ALL_THIS_SHIT_AND_ME_LEFT_2_DAYS_UNTIL_RETIREMENT - 35;
    }

    public function sex()
    {
        return \Human\Best\Programmer::DEFAULT_SEX;
    }

    public $skills = array(
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
        'https://github.com/jlipinio/MVC-test' => 'Описание на странице',
        'Разное' => array(
            'Делал всякие мелочи: Установка CMS-ок, копирование/правка дизайна, установка/редактирования плагинов, приложения для VK.',
            'Взламывал Пентагон. Ничего необычного, все так делали!? Но! Меня, меня взламывал... Хотя выяснить, сколько нас всего прилетело на землю.'
        )
    );

    public $test = array(
        'http://www.quizful.net/user/jlipinio' => 'Хорошие тесты, нехорошие результаты :)'
    );

    private function goals_of_work($skills)
    {
        foreach($skills as $key => $value) {
            if(is_array($value))
                $value = $this->goals_of_work($value);
            else
                $value = 'expert';

            $skills[$key] = $value;
        }

        return $skills;
    }

} 