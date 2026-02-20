## Auth
  * register, login, Logout(laravel breeze)
  * profile page with avatar and bio

## Blog
  * Create, Edit, Delete Post(CRUD)
  * Rich text editor (use TinyMCE or Quill - just a cdn link)
  * Thumbnail/ cover image upload
  * category or tags

## Discover
  * home feed showing all published blogs
  * single blog post page
  * search by titile or category
  * pagination

## Engagement 
  * Like a post (AJAX so no relaod page)
  * Bookmark / save post
  * Comment on a post

## Tech Stack
  * backend - Laravel + tailwindcss
  * database - mysql
  * auth - laravel breeze
  * editor - TinyMCE(CDN)
  * image - laravel storage

## DB TABLE
  * users: name, email, password, bio, avatar 
  * posts : user_id , title, slug, body, image, category_id, published_at
  * categorys : name, slug
  * likes: user_id, post_id
  * bookmark: user_id, post_id
  * comments: user_i, post_id, body

