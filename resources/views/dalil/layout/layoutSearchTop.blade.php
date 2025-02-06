<div class="section-search">
    <div class="container mt-3 mb-2 d">
        <div class="search_mainIndex editSearch">
            <form id="searchthis" action="{{ route('search') }}" style="display:inline;" method="get">

                <input id="search_inp" name="q" type="text" placeholder="ما الذي تبحث عنه؟" required />
                <button id="btn_search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>



                <!-- {{-- <button class="navbar-search_button">
                    <i class="fa fa-search"></i>
                </button> --}} -->
            </form>

        </div>

    </div>
</div>
<div style="text-align: -webkit-center;">
    <div class="col col-sm-12 col-md-8 col-lg-6  ">
        <div class="input-group" dir="ltr">
            <div class="input-group-prepend">
                <button class="input-group-text btn btn-secondary " style="padding: 15px;margin: 0px"><i
                        class="fa fa-sliders  fa-rotate-90" aria-hidden="true"></i></i></button>
                <button class="input-group-text btn btn-primary"
                    style="padding: 15px;background-color: #4991f5;border: 0; margin: 0px"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <input type="text" dir="rtl" style="padding: 15px" class="form-control"
                placeholder="Input group example" aria-label="Input group example" aria-describedby="btnGroupAddon">
        </div>
    </div>

</div>
