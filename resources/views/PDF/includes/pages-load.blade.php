<div class="row" style="padding: 20px 30px">
    @foreach($pages as $page)
        <div class="col" style="margin: 10px;background: #fff">
                <div class="card" style="width: 100%;padding: 20px 30px">
                    <div class="card-body">
                        <a href="{{route('view-Page',[$page->id])}}">

                        <h5 class="card-title">Page {{$page->title}}</h5>
                        <p class="card-text">{{$page->title}}</p>
            </a>
            <a href="javascript:void(0)" onclick="deletePage({{$page->id}})"><i class="bi bi-trash" style="color: red"></i></a>
        </div>
                </div>

        </div>

@endforeach
        <div class="col" style="margin: 20px; ">
            <a href="javascript:void(0)" onclick="openPage()">
                <div class="card" style="width: 100%;height:100%;background: #0a53be;align-items: center;">
                    <div class="card-body">
                        <h4 style="color: #fff;margin-top: 100% ;font-size: 3rem"><i class="bi bi-plus-lg"></i></h4>
                    </div>
                </div>
            </a>
        </div>
        </div>
