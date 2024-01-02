<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tag;
use App\Models\Like;
use App\Models\User;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $users = User::factory()->count(50)->create();

        $questions = Question::factory()->count(100)->create();

        $answers = Answer::factory()->count(150)->create();

        Tag::create([
            'tagname' => 'Học tập',
        ]);
        Tag::create([
            'tagname' => 'Nhà trọ',
        ]);
        Tag::create([
            'tagname' => 'Chỗ ở',
        ]);
        Tag::create([
            'tagname' => 'Làm thêm',
        ]);
        Tag::create([
            'tagname' => 'Thực tập',
        ]);
        Tag::create([
            'tagname' => 'Sự nghiệp',
        ]);
        Tag::create([
            'tagname' => 'Học phí',
        ]);
        Tag::create([
            'tagname' => 'Học bổng',
        ]);
        Tag::create([
            'tagname' => 'Công việc',
        ]);
        Tag::create([
            'tagname' => 'Đồ án',
        ]);
        Tag::create([
            'tagname' => 'Điểm rèn luyện',
        ]);
        Tag::create([
            'tagname' => 'Câu lạc bộ',
        ]);
        Tag::create([
            'tagname' => 'Kỹ năng mềm',
        ]);
        Tag::create([
            'tagname' => 'Cuộc sống',
        ]);
        Tag::create([
            'tagname' => 'Nghiên cứu',
        ]);
        Tag::create([
            'tagname' => 'Cao học',
        ]);

        $tags = Tag::all();
        // Seed the pivot table with random attachments
        foreach ($questions as $question) {
            // Get a random number of tags to attach (between 1 and the total number of tags)
            $numberOfTagsToAttach = rand(1, 5);

            // Attach random tags to the product
            $randomTags = $tags->random($numberOfTagsToAttach);
            $question->tags()->attach($randomTags);
        }

        foreach ($questions as $question) {
            $numberOfLikes = rand(0, $users->count());
            $randomUsers = $users->random($numberOfLikes);
            foreach ($randomUsers as $randomUser) {
                $question->likes()->create([
                    'user_id' => $randomUser->id,
                ]);
            }
        }

        foreach ($answers as $answer) {
            $numberOfLikes = rand(0, $users->count());
            $randomUsers = $users->random($numberOfLikes);
            foreach ($randomUsers as $randomUser) {
                $answer->likes()->create([
                    'user_id' => $randomUser->id,
                ]);
            }
        }
    }
}
