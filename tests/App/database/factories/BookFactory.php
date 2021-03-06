<?php
declare(strict_types=1);

use Carbon\Carbon;
use ElasticScoutDriverPlus\Tests\App\Author;
use ElasticScoutDriverPlus\Tests\App\Book;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory  */
$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(5),
        'description' => $faker->realText(),
        'price' => $faker->randomFloat(2, 1, 1000),
        'published' => Carbon::createFromFormat('Y-m-d', $faker->date('Y-m-d')),
    ];
});

$factory->afterMakingState(Book::class, 'belongs_to_author', function (Book $book, Faker $faker) {
    $book->author_id = factory(Author::class)->create()->id;
});
