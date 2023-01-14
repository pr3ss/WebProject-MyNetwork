        <!--Intestazine profilo-->
        <div class="row bg-white ">
            <div class="col-2"></div>
            <div class="col-8 d-flex flex-column">
                <img src="..\img\logo.jpg" class="p-3" style="border-radius: 50%;">
            </div>
            <div class="col-2"></div>
            <div class="col-12">
                <dic class="row justify-content-center">
                    <p>SimoneLuga</p>
                </dic>
            </div>
            <div class="col-6">
                <div class="row justify-content-center m-2">
                    <button type="button" class="btn btnshadow" onclick="viewFollower()"><i class="fa-solid fa-user"></i>
                        FOLLOWER</i></button>
                </div>
            </div>
            <div class="col-6">
                <div class="row justify-content-center m-2">
                    <button type="button" class="btn btnshadow btn-dark" onclick="viewSeguiti()"><i class="fa-solid fa-user">
                            SEGUITI</i></button>
                </div>
            </div>
            <div class="col-12">
                <p class="p-2">Ciao Luga é scemo.</p>
            </div>
        </div>

        <div class="row mt-3 justify-content-center">
            <!--Posts profilo-->
            <div class="container mr-5 ml-5 p-1 bg-white " style="border-radius: 10px;">
                <div class="row d-flex justify-content-center pl-3 pr-3">
                    <div class="col-4">
                        <button type="button" class="btn btnshadow w-100"><i class="fa-solid fa-heart">
                                <p class="m-0">919</p>
                            </i></button>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btnshadow w-100" onclick="openPost()"><i class="fa-solid fa-comment">
                                <p class="m-0">100</p>
                            </i></button>
                    </div>
                    <div class="col-4 d-flex flex-column justify-content-center">
                        <button type="button" class="btn btnshadow w-100" onclick="openModalDelate()"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(21).webp" class="card-img-top p-2" alt="..." onclick="openPost()">
            </div>
        </div>