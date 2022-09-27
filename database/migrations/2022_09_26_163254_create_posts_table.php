<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class CreatePostsTable extends Migration
{
    /**
     * string constants for foreign keys and indexes
     */
    public const POST_CATEGORY_FOREIGN_KEY = 'post_category_fk';
    public const POST_CATEGORY_INDEX = 'post_category_idx';
    public const POST_USER_FOREIGN_KEY = 'post_user_fk';
    public const POST_USER_INDEX = 'post_user_idx';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Post::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string(Post::TITLE);
            $table->string(Post::IMAGE)->nullable();
            $table->unsignedBigInteger(Post::CATEGORY_ID);
            $table->unsignedBigInteger(Post::POSTED_BY);
            $table->timestamps();

            $table->softDeletes();

            $table->foreign(Post::CATEGORY_ID,self::POST_CATEGORY_FOREIGN_KEY)
                ->references('id')
                ->on(Category::TABLE_NAME);
            $table->index(Post::CATEGORY_ID, self::POST_CATEGORY_INDEX);

            $table->foreign(Post::POSTED_BY, self::POST_USER_FOREIGN_KEY)
                ->references('id')
                ->on(User::TABLE_NAME);
            $table->index(Post::POSTED_BY, self::POST_USER_INDEX);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Post::TABLE_NAME);
    }
}
