<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $products = [
            [
                "id" => 1,
                "title" => "The Flutter Journey",
                "author" => "Jane Doe",
                "price" => 9.99,
                "rating" => 4.5,
                "description" => "An in-depth guide to mastering Flutter development.",
                "coverImageUrl" => "https://m.media-amazon.com/images/I/51WMIz-aCtL._SL500_.jpg"
            ],
            [
                "id" => 2,
                "title" => "Dart for Beginners",
                "author" => "John Smith",
                "price" => 7.99,
                "rating" => 4.2,
                "description" => "Learn Dart programming from scratch with practical examples.",
                "coverImageUrl" => "https://i5.walmartimages.com/seo/Book-of-The-Book-of-Amazing-History-Hardcover-9781450807456_fa365337-cc2b-44c4-937c-683a0fffd5a4.d786a2f0b45d42926d830c13b4e9655f.jpeg"
            ],
            [
                "id" => 3,
                "title" => "Mobile App Design Principles",
                "author" => "Emily Brown",
                "price" => 12.49,
                "rating" => 4.8,
                "description" => "A comprehensive guide to designing beautiful and functional mobile apps.",
                "coverImageUrl" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSGQsV_U9CniP-blwPIPZ5Nk8fLVwQwIcpciw&s"
            ],
            [
                "id" => 4,
                "title" => "Advanced Flutter Widgets",
                "author" => "Michael Green",
                "price" => 14.99,
                "rating" => 4.7,
                "description" => "Explore the power of Flutter widgets with advanced use cases.",
                "coverImageUrl" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR_rbUKIu7KE7yP8kdKoyiifsE9GLozaC_46Q&s"
            ],
            [
                "id" => 5,
                "title" => "Building RESTful APIs",
                "author" => "Sophia Wilson",
                "price" => 8.99,
                "rating" => 4.3,
                "description" => "Learn how to build efficient and scalable RESTful APIs.",
                "coverImageUrl" => "https://m.media-amazon.com/images/I/51WMIz-aCtL._SL500_.jpg"
            ],
            [
                "id" => 6,
                "title" => "UI/UX Design Basics",
                "author" => "David Johnson",
                "price" => 11.99,
                "rating" => 4.6,
                "description" => "A beginner's guide to understanding the fundamentals of UI/UX design.",
                "coverImageUrl" => "https://i5.walmartimages.com/seo/Book-of-The-Book-of-Amazing-History-Hardcover-9781450807456_fa365337-cc2b-44c4-937c-683a0fffd5a4.d786a2f0b45d42926d830c13b4e9655f.jpeg"
            ],
            [
                "id" => 7,
                "title" => "State Management in Flutter",
                "author" => "Laura Lee",
                "price" => 10.49,
                "rating" => 4.4,
                "description" => "Master state management techniques in Flutter with hands-on examples.",
                "coverImageUrl" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcPwNfUqsR1rtrfuJtfGHSWklh2aJhi3eiCA&s"
            ],
            [
                "id" => 8,
                "title" => "Database Integration in Mobile Apps",
                "author" => "Chris Taylor",
                "price" => 13.99,
                "rating" => 4.7,
                "description" => "A step-by-step guide to integrating databases in mobile applications.",
                "coverImageUrl" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLpfpDnfeIhjvFP56W1ffJwuKbnSuTJEThYg&s"
            ],
            [
                "id" => 9,
                "title" => "Animation in Flutter",
                "author" => "Anna White",
                "price" => 15.99,
                "rating" => 4.9,
                "description" => "Discover how to create stunning animations in Flutter with ease.",
                "coverImageUrl" => "https://uncpress-us.imgix.net/covers/9781469633862.jpg?auto=format&h=648"
            ],
            [
                "id" => 10,
                "title" => "Testing Flutter Applications",
                "author" => "William Black",
                "price" => 9.49,
                "rating" => 4.5,
                "description" => "A practical guide to testing Flutter applications effectively.",
                "coverImageUrl" => "https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1470421195i/28789711.jpg"
            ],
        ];

        foreach ($products as $product) {
            Product::factory()->create($product);
        }
    }
}