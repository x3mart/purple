<div class="ui-block revealator-fade revealator-delay3 revealator-once">
    <div class="ui-block-title">
        <h6 class="title">Фото ({{ $imagesCount() }})</h6>
    </div>
    <div class="ui-block-content">
        <ul class="widget w-last-photo js-zoom-gallery">
            @foreach ($images as $item)
                @if ($loop->iteration < 9)
                    <li>
                        <a href="#">
                            <img src="{{ $imgSrc($item->image) }}" alt="photo">
                        </a>
                    </li>
                @else
                    <li style="display : none">
                        <a href="{{ $imgSrc($item->image) }}"></a>
                    </li>
                @endif
            @endforeach
            @if ($imagesCount()-8 > 0)
                <li class="all-users">
                    <a href="#">+{{ $imagesCount()-8 }}</a>
                </li>
            @endif
        </ul>
    </div>
</div>

<script>
    // function img() {
    //     var dataSrc = document.getElementsByClassName("photo-src");
    //     var modalImg = document.getElementsByClassName("modal-img");
    //     console.log(modalImg);
    //     for (let i = 0; i < dataSrc.length; i++) {
    //         var currentSrc = dataSrc[i].getAttribute('data-src');
    //         console.log(currentSrc);
    //     }
    //     for (let l = 0; l < modalImg.length; l++) {
    //         modalImg[l].setAttribute('src', currentSrc);
    //         console.log(modalImg[l])
    //     }
    // }
    // img();

</script>
