@extends('layouts.frontend')

@section('content')
<!-- Jumbotron section -->
<section class="jumbothron">
    <div class="jumbothron-wrapper">
        <div class="content">
            <h1>AirAsia to buy 150 new Airbus 321XLR</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. A, distinctio cumque vel aperiam corrupti labore culpa aliquam? Praesentium ipsam ea, pariatur error, est fuga eveniet autem rerum ad ex debitis.</p>
            <a class="button" href="#">Читать</a>
        </div>
        <div class="photo">
            <img src="{{ asset('images/qatar.jpg') }}" alt="News">
        </div>
    </div>
</section>

<!-- News section -->
<section class="news">
    <h1>Latest news</h1>
    <div class="news-wrapper">
        @foreach ($news as $news_item)
        <div class="item ">
            <div class="image-holder">
                <a href="#"><img src="{{ $news_item->photo->path ?? ''  }}" alt="Photo"></a>
            </div>
            <div class="item-content">
                <a href="#">
                    <h6>{{ $news_item->title }}</h6>
                </a>
                <p class="item-blog-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nemo, accusantium?</p>
                <p class="item-blog-author"><i class="fas fa-user-edit"></i>By <a href="#">Volodymyr Zhonchuk</a></p>
                <p><i class="fas fa-clock"></i>{{ $news_item->time_to_read }} minutes to read</p>
                <p class="item-blog-date">October5, 2019</p>
                <p class="item-blog-comment">Comments: 4</p>
                <div class="blog-line">
                    <span></span>
                </div>

                <div class="item-blog-bottom">
                    <a href="#" class="button">Читать</a>
                    <p><i class="fas fa-tags"></i><a href="#">History</a></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</section>

<section class="news-pagination">
    {{ $news->links() }}
</section>
@endsection