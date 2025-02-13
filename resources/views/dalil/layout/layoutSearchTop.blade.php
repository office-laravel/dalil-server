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
