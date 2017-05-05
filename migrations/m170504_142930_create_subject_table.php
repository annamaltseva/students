<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subject`.
 */
class m170504_142930_create_subject_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subject', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->insert('subject', [
            'name' => 'Компьютерная графика',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Верификация и тестирование программного обеспечения',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Теория принятия решений',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Технологии разработки качественного программного обеспечения',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Метрология и стандартизация программного обеспечения',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Сети и телекоммуникации',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Защита информации',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Программирование периферийных устройств',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Основы процесса разработки качественного программного продукта и его метрология',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Авторское право и стандартизация программных средств',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Архитектура резервного копирования и восстановления данных',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Моделирование дискретных систем',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Теория вероятностей и математическая статистика',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Базы данных',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Архитектура программных систем (на английском языке)',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Методы оптимизации',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Основы теории управления',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Микропроцессорные системы',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Конструирование программного обеспечения',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Математическая логика и теория алгоритмов',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Теория автоматов и формальных языков',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Статистическое моделирование случайных процессов и систем',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Моделирование систем на UML',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Математические модели систем c распределёнными параметрами',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Цифровая обработка сигналов',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Управление в технических системах',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Управление информацией и хранением данных',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Вычислительная математика',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Объектно-ориентированное программирование',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Микроэлектроника, схемотехника и проектирование устройств вычислительной техники',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Основы вычислительной техники',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Операционные системы',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Информатика',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Дискретная математика',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Алгоритмизация и основы программирования',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Технологии программирования',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Высшая математика',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Физика',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Программирование',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Основы разработки программного обеспечения',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Проектирование системного программного обеспечения',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Математические модели',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Пакеты проектирования программно-аппаратных комплексов',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Системный анализ и принятие решений',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Индустриальные технологии разработки программного обеспечения',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Статистическое моделирование случайных процессов',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Параллельное программирование',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Микроконтроллеры и сигнальные процессоры',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Прикладное программирование',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Микроэлектроника',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'История и методология науки и техники',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Высокопроизводительные и встраиваемые вычисления',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Системы программирования',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Технологии верификации и тестирования программного обеспечения',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Функциональное и логическое программирование',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Процессы управления качеством программного обеспечения',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Управление конфигурацией и менеджмент программного проекта',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Наука о данных и аналитика больших объемов информации',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Технология биоинформатики',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Иностранный язык в профессиональной сфере',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Облачные инфраструктуры и сервисы',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Распределенные алгоритмы и протоколы',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Технология проектирования "система на кристалле"',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Цифровая обработка многомерных сигналов',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Программирование встроенных приложений на ассемблере',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Электротехника и электроника',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Структуры и алгоритмы обработки данных',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Программирование на языке высокого уровня',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Организация ЭВМ и систем',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Математические модели технических объектов',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Теория вычислительных процессов',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Информационные технологии',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Дизайн и программирование web сайтов',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Методы и средства защиты компьютерной информации',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Дополнительные главы математической логики',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('subject', [
            'name' => 'Регрессионные методы обработки изображений',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subject');
    }
}
