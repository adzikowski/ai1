<?php
namespace App\Model;

use App\Service\Config;

class Post
{
    private ?int $id = null;
    private ?string $recipeName = null;
    private ?int $recipeTime = null;
    private ?string $recipeDescription = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Post
    {
        $this->id = $id;

        return $this;
    }

    public function getRecipeName(): ?string
    {
        return $this->recipeName;
    }

    public function setRecipeName(?string $recipeName): Post
    {
        $this->recipeName = $recipeName;

        return $this;
    }

    public function getRecipeDescription(): ?string
    {
        return $this->recipeDescription;
    }

    public function setRecipeDescription(?string $recipeDescription): Post
    {
        $this->recipeDescription = $recipeDescription;

        return $this;
    }

    public function getRecipeTime():?int{
        return $this->recipeTime;
    }
    public function setRecipeTime(?int $recipeTime):Post{
        $this->recipeTime=$recipeTime;
        return $this;
    }

    public static function fromArray($array): Post
    {
        $post = new self();
        $post->fill($array);

        return $post;
    }

    public function fill($array): Post
    {
        if (isset($array['id']) && ! $this->getId()) {
            $this->setId($array['id']);
        }
        if (isset($array['recipeName'])) {
            $this->setRecipeName($array['recipeName']);
        }
        if (isset($array['recipeTime'])) {
            $this->setRecipeTime($array['recipeTime']);
        }
        if (isset($array['recipeDescription'])) {
            $this->setRecipeDescription($array['recipeDescription']);
        }

        return $this;
    }

    public static function findAll(): array
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM post';
        $statement = $pdo->prepare($sql);
        $statement->execute();

        $posts = [];
        $postsArray = $statement->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($postsArray as $postArray) {
            $posts[] = self::fromArray($postArray);
        }

        return $posts;
    }

    public static function find($id): ?Post
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = 'SELECT * FROM post WHERE id = :id';
        $statement = $pdo->prepare($sql);
        $statement->execute(['id' => $id]);

        $postArray = $statement->fetch(\PDO::FETCH_ASSOC);
        if (! $postArray) {
            return null;
        }
        $post = Post::fromArray($postArray);

        return $post;
    }

    public function save(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        if (! $this->getId()) {
            $sql = "INSERT INTO post (recipeName, recipeDescription, recipeTime) VALUES (:recipeName, :recipeDescription, :recipeTime)";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':recipeName' => $this->getRecipeName(),
                'recipeTime' => $this->getRecipeTime(),
                ':recipeDescription' => $this->getRecipeDescription()
            ]);

            $this->setId($pdo->lastInsertId());
        } else {
            $sql = "UPDATE post SET recipeName = :recipeName ,recipeTime=:recipeTime , recipeDescription = :recipeDescription WHERE id = :id";
            $statement = $pdo->prepare($sql);
            $statement->execute([
                ':recipeName' => $this->getRecipeName(),
                'recipeTime' => $this->getRecipeTime(),
                'recipeDescription' => $this->getRecipeDescription(),
                ':id' => $this->getId()
            ]);
        }
    }

    public function delete(): void
    {
        $pdo = new \PDO(Config::get('db_dsn'), Config::get('db_user'), Config::get('db_pass'));
        $sql = "DELETE FROM post WHERE id = :id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':id' => $this->getId(),
        ]);

        $this->setId(null);
        $this->setRecipeName(null);
        $this->setRecipeTime(null);
        $this->setRecipeDescription(null);
    }
}
