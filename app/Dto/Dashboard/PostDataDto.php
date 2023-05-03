<?php

namespace App\Dto\Dashboard;

class PostDataDto
{
    /**
     * Create a new instance.
     *
     * @param $title
     * @param $body
     * @param $description
     * @param $time_to_read
     * @param $photo_source
     * @param $published
     * @param $category_id
     * @return void
     */
    public function __construct(
        private string $title,
        private string $body,
        private string $description,
        private int $time_to_read,
        private ?string $photo_source,
        private bool $published,
        private int $category_id
    ) {
        $this->title = $title;
        $this->body = $body;
        $this->description = $description;
        $this->time_to_read = $time_to_read;
        $this->photo_source = $photo_source;
        $this->published = $published;
        $this->category_id = $category_id;
    }

    /**
     * Get a post title.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get a post body.
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Get a post description.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get a post time to read attribute.
     *
     * @return int
     */
    public function getTimeToRead(): int
    {
        return $this->time_to_read;
    }

    /**
     * Get a post photo source.
     *
     * @return mixed
     */
    public function getPhotoSource(): ?string
    {
        return $this->photo_source;
    }

    /**
     * Get a post published attribute.
     *
     * @return bool
     */
    public function getPublished(): bool
    {
        return $this->published;
    }

    /**
     * Get a post's category id.
     *
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }
}
