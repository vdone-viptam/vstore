$(document).ready(function () {
    var svgShowPass = `
    <path d="M15.6822 7.5404C13.9894 3.97433 11.4305 2.17969 8.0001 2.17969C4.56796 2.17969 2.01082 3.97433 0.31796 7.54219C0.250059 7.68597 0.214844 7.843 0.214844 8.00201C0.214844 8.16102 0.250059 8.31805 0.31796 8.46183C2.01082 12.0279 4.56975 13.8225 8.0001 13.8225C11.4322 13.8225 13.9894 12.0279 15.6822 8.46005C15.8197 8.17076 15.8197 7.83505 15.6822 7.5404V7.5404ZM8.0001 12.5368C5.11975 12.5368 3.01082 11.0761 1.52332 8.00112C3.01082 4.92612 5.11975 3.4654 8.0001 3.4654C10.8805 3.4654 12.9894 4.92612 14.4769 8.00112C12.9912 11.0761 10.8822 12.5368 8.0001 12.5368ZM7.92867 4.85826C6.19296 4.85826 4.78582 6.2654 4.78582 8.00112C4.78582 9.73683 6.19296 11.144 7.92867 11.144C9.66439 11.144 11.0715 9.73683 11.0715 8.00112C11.0715 6.2654 9.66439 4.85826 7.92867 4.85826ZM7.92867 10.0011C6.82332 10.0011 5.92867 9.10647 5.92867 8.00112C5.92867 6.89576 6.82332 6.00112 7.92867 6.00112C9.03403 6.00112 9.92868 6.89576 9.92868 8.00112C9.92868 9.10647 9.03403 10.0011 7.92867 10.0011Z" fill="black" fill-opacity="0.45"/>

    `
    var svgHidePass = `
    <path d="M15.6822 7.53757C15.0545 6.21507 14.3075 5.1365 13.4412 4.30185L12.5326 5.21043C13.2735 5.91846 13.9188 6.84471 14.4769 7.99828C12.9912 11.0733 10.8822 12.534 8.0001 12.534C7.13498 12.534 6.33813 12.4008 5.60956 12.1344L4.6251 13.1188C5.637 13.5861 6.762 13.8197 8.0001 13.8197C11.4322 13.8197 13.993 12.0322 15.6822 8.45721C15.7502 8.31344 15.7854 8.1564 15.7854 7.99739C15.7854 7.83838 15.7502 7.68135 15.6822 7.53757ZM14.5471 1.81185L13.7858 1.04971C13.7725 1.03643 13.7568 1.02589 13.7394 1.0187C13.7221 1.01151 13.7035 1.00781 13.6847 1.00781C13.666 1.00781 13.6474 1.01151 13.63 1.0187C13.6127 1.02589 13.5969 1.03643 13.5837 1.04971L11.6306 3.00185C10.5538 2.45185 9.34367 2.17685 8.0001 2.17685C4.56796 2.17685 2.00724 3.96435 0.317957 7.53935C0.250055 7.68313 0.21484 7.84017 0.21484 7.99918C0.21484 8.15818 0.250055 8.31522 0.317957 8.459C0.992837 9.88043 1.80534 11.0198 2.75546 11.877L0.865814 13.7661C0.839043 13.7929 0.824005 13.8293 0.824005 13.8671C0.824005 13.905 0.839043 13.9413 0.865814 13.9681L1.62813 14.7304C1.65492 14.7572 1.69125 14.7722 1.72912 14.7722C1.76699 14.7722 1.80331 14.7572 1.8301 14.7304L14.5471 2.014C14.5603 2.00073 14.5709 1.98497 14.5781 1.96763C14.5853 1.95029 14.589 1.9317 14.589 1.91293C14.589 1.89415 14.5853 1.87556 14.5781 1.85822C14.5709 1.84088 14.5603 1.82512 14.5471 1.81185ZM1.52331 7.99828C3.01081 4.92328 5.11974 3.46257 8.0001 3.46257C8.97403 3.46257 9.85956 3.62971 10.663 3.96953L9.4076 5.22489C8.81308 4.90768 8.13234 4.78996 7.46582 4.88908C6.7993 4.9882 6.18228 5.29893 5.7058 5.77541C5.22931 6.2519 4.91859 6.86891 4.81947 7.53544C4.72034 8.20196 4.83807 8.88269 5.15528 9.47721L3.66563 10.9669C2.84117 10.2392 2.13046 9.25328 1.52331 7.99828ZM5.92867 7.99828C5.92898 7.6834 6.00357 7.37303 6.14637 7.09238C6.28917 6.81174 6.49615 6.56874 6.75051 6.38312C7.00487 6.1975 7.29943 6.0745 7.61025 6.02411C7.92108 5.97372 8.23941 5.99736 8.53938 6.0931L6.02349 8.609C5.96043 8.41157 5.92844 8.20554 5.92867 7.99828Z" fill="black" fill-opacity="0.45"/>
    <path d="M7.92897 10.0012C7.86719 10.0012 7.80629 9.99839 7.74594 9.99286L6.80272 10.9361C7.37003 11.1533 7.98812 11.2016 8.58228 11.0751C9.17643 10.9485 9.72122 10.6526 10.1508 10.2231C10.5803 9.7935 10.8763 9.24871 11.0028 8.65455C11.1293 8.0604 11.0811 7.4423 10.8638 6.875L9.92058 7.81821C9.92612 7.87857 9.92897 7.93946 9.92897 8.00125C9.92911 8.26393 9.87748 8.52407 9.77702 8.76678C9.67656 9.0095 9.52925 9.23003 9.3435 9.41578C9.15776 9.60152 8.93722 9.74884 8.69451 9.8493C8.45179 9.94976 8.19166 10.0014 7.92897 10.0012Z" fill="black" fill-opacity="0.45"/>
    `

    $('.btn-ctn').attr('href', 'javascript:void(0)')
    // $('.tab-register li').on('click', function(){
    //     $('.tab-register li').removeClass('active');
    //     $(this).addClass('active');
    //     if($(this).hasClass('active')){
    //         $('.modal-chuyen').toggleClass('show-modal');
    //         $('.modal-chuyen').html(` <div class="over-lay-modal" ></div>
    //         <div class="information flex flex-col bg-[#FFFF] w-full max-w-[300px] md:max-w-[750px]  shadow-xl p-3 py-6 md:p-6 mx-auto mt-24 rounded-sm">
    //             <div class="content pt-3 px-3 flex justify-start items-start gap-4">
    //             <div class="w-[23px]">
    //                 <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
    //                 <g clip-path="url(#clip0_4_22129)">
    //                 <path d="M11 0C4.92545 0 0 4.92545 0 11C0 17.0746 4.92545 22 11 22C17.0746 22 22 17.0746 22 11C22 4.92545 17.0746 0 11 0ZM11 20.1339C5.9567 20.1339 1.86607 16.0433 1.86607 11C1.86607 5.9567 5.9567 1.86607 11 1.86607C16.0433 1.86607 20.1339 5.9567 20.1339 11C20.1339 16.0433 16.0433 20.1339 11 20.1339Z" fill="#FFC53D"/>
    //                 <path d="M9.82104 15.3214C9.82104 15.634 9.94522 15.9338 10.1662 16.1548C10.3873 16.3758 10.687 16.5 10.9996 16.5C11.3122 16.5 11.612 16.3758 11.833 16.1548C12.054 15.9338 12.1782 15.634 12.1782 15.3214C12.1782 15.0089 12.054 14.7091 11.833 14.4881C11.612 14.267 11.3122 14.1429 10.9996 14.1429C10.687 14.1429 10.3873 14.267 10.1662 14.4881C9.94522 14.7091 9.82104 15.0089 9.82104 15.3214ZM10.4103 12.5714H11.5889C11.6969 12.5714 11.7853 12.483 11.7853 12.375V5.69643C11.7853 5.58839 11.6969 5.5 11.5889 5.5H10.4103C10.3023 5.5 10.2139 5.58839 10.2139 5.69643V12.375C10.2139 12.483 10.3023 12.5714 10.4103 12.5714Z" fill="#FFC53D"/>
    //                 </g>
    //                 <defs>
    //                 <clipPath id="clip0_4_22129">
    //                 <rect width="22" height="22" fill="white"/>
    //                 </clipPath>
    //                 </defs>
    //                 </svg>
    //             </div>
    //             <div class="flex flex-col justify-start items-start gap-2">
    //                 <h2 class="text-lg text-title font-medium">Bạn đang chọn lại...</h2>
    //                 <span class="text-title">Thông tin đăng ký của bạn đang chờ duyệt. Vui lòng chờ kết quả trong vòng (n giờ)</span>
    //             </div>
    //             </div>
    //         </div>`)
    //         setTimeout(() => {
    //             $('.modal-chuyen').toggleClass('show-modal');
    //         }, 2000);
    //     }
    // })
    $('.check-item .item').on('click', function () {
        $(this).addClass('active');
        $('.btn-ctn').addClass('active')
        checkRegister()
    })
    $('.password .icon').on('click', function () {

        if ($('.pass input').attr('type') == 'password') {
            $('.pass input').prop("type", "text");
            $('.password .icon').html(svgShowPass)

        } else {
            $('.pass input').prop("type", "password")
            $('.password .icon').html(svgHidePass)
        }
    })
    // $('.more-details').each(function () {
    //     $(this).on('click', function () {
    //         console.log(1)
    //         $('.modal-details').toggleClass('show-modal');
    //     });
    // })
    $('.rePassword .icon').on('click', function () {
        if ($('.rePass input').attr('type') == 'text') {
            $('.rePass input').prop("type", "password")
            $('.rePassword .icon').html(svgHidePass)
        } else {
            $('.rePass input').prop("type", "text");
            $('.rePassword .icon').html(svgShowPass)
        }
    })
    $('.edit-hs').on('click', function () {
        $('.modal-hd').toggleClass('show-modal')
    })
    $('.btn-add-address').on('click', function () {
        $('.modal-address').toggleClass('show-modal')
    })

    function checkRegister() {
        if ($('.btn-ctn').hasClass('active')) {
            $('.btn-ctn').attr('href', './v-store.html')
        }
    }

    let arrImage = [];

    function render(arrImage) {
        const html = arrImage.map((item, index) => {
            return `<div class="item w-[102px] h-[102px] flex justify-center items-center relative">
                <div class="over-lay"></div>
                <svg width="16" height="16" data-index="${index}"  class="deleteImg cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
</svg>
            <img src="${item}" class="w-full h-full"></div>`;
        }).join("")
        $('.file-name').html(html);
        document.getElementById('countImage').innerHTML = arrImage.length + '/9';

        document.getElementById('photo_gallery').value = JSON.stringify(arrImage);
        document.querySelectorAll('.deleteImg').forEach(item => {
            const {index} = item.dataset;
            item.addEventListener('click', () => {
                arrImage = arrImage.filter((item1, index1) => index1 !== +index);
                render(arrImage);
            })
        })
    }

    $('.giayDK').on('click', function () {
        let input = document.createElement('input');
        input.type = 'file';
        input.onchange = _ => {
            var files = Array.from(input.files);
            const reader = new FileReader();

            return new Promise(resolve => {
                reader.onload = ev => {
                    resolve(ev.target.result)
                    $('.file-name').append(`<div class="item w-[104px] h-[104px] flex justify-center items-center relative">
                        <div class="over-lay"></div>
                        <svg width="16" height="16" class="deleteImg cursor-pointer" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.28544 2.14118H5.14258C5.22115 2.14118 5.28544 2.0769 5.28544 1.99833V2.14118H10.714V1.99833C10.714 2.0769 10.7783 2.14118 10.8569 2.14118H10.714V3.4269H11.9997V1.99833C11.9997 1.36797 11.4872 0.855469 10.8569 0.855469H5.14258C4.51222 0.855469 3.99972 1.36797 3.99972 1.99833V3.4269H5.28544V2.14118ZM14.2854 3.4269H1.71401C1.39794 3.4269 1.14258 3.68225 1.14258 3.99833V4.56975C1.14258 4.64833 1.20686 4.71261 1.28544 4.71261H2.36401L2.80508 14.0519C2.83365 14.6608 3.33722 15.1412 3.94615 15.1412H12.0533C12.664 15.1412 13.1658 14.6626 13.1944 14.0519L13.6354 4.71261H14.714C14.7926 4.71261 14.8569 4.64833 14.8569 4.56975V3.99833C14.8569 3.68225 14.6015 3.4269 14.2854 3.4269ZM11.9158 13.8555H4.08365L3.65151 4.71261H12.3479L11.9158 13.8555Z" fill="white"/>
</svg>
                    <img src="${ev.target.result}" class="w-full h-full"></img></div>`)
                }
                reader.readAsDataURL(files[0])
            })
        };
        input.click();
    })

    $('.img-info').on('click', function () {
        let input = document.createElement('input');
        input.type = 'file';
        input.onchange = _ => {
            var files = Array.from(input.files);
            const reader = new FileReader();

            return new Promise(resolve => {
                reader.onload = ev => {
                    resolve(ev.target.result)
                    arrImage.push(ev.target.result);
                    render(arrImage);

                }
                reader.readAsDataURL(files[0])
            })
        };
        input.click();
    })

    $('.img-gt-info').on('click', function () {
        let input = document.createElement('input');
        input.type = 'file';
        input.onchange = _ => {
            var files = Array.from(input.files);
            const reader = new FileReader();

            return new Promise(resolve => {
                reader.onload = ev => {
                    resolve(ev.target.result)
                    arrImage.push(ev.target.result);
                    render(arrImage);
                }
                reader.readAsDataURL(files[0])
            })
        };
        input.click();
    })
    $('.btnHD').on('click', function () {
        $('.modal-hd').toggleClass('show-modal');
    })

    function coundownXT() {
        var timer2 = "2:00";
        var interval = setInterval(function () {
            var timer = timer2.split(':');
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;

            $('.smsXT input[type="button"]').replaceWith(`<input type="button" class="disabled btnXT outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 w-full text-center text-[#FFFFFF]" value="Nhậ mã xác thực qua SMS (${minutes + ':' + seconds})" disabled></input>`)
            timer2 = minutes + ':' + seconds;
            console.log(timer2)
            if (timer2 == "0:00") {
                clearInterval(interval);
                $('.smsXT input[type="button"]').replaceWith(`<input type="button" class="btnXT cursor-pointer outline-none bg-primary transition-all duration-200 rounded-sm py-2 px-3 w-full text-center text-[#FFFFFF] hover:opacity-70" value="Nhận mã xác thực qua SMS" ></input>`)
                coundownXT();
            }
        }, 1000);
    }

    $('.smsXT input[type="button"]').on('click', function () {
        coundownXT()
    })
    $('.btn-sub-sign').on('click', function () {
        $('.modal-success').toggleClass('show-modal')
    })

    $('.menuMB').on('click', function () {
        $('.menu-mobile').toggleClass('show-menuMB')
    })
    $('.nav-menu li').on('click', function () {
        $('.nav-menu li').removeClass('active')
        $(this).addClass('active')
    });
    $('.tab-th li').on('click', function () {
        $('.tab-th li').removeClass('active')
        $(this).addClass('active')
    });
    $('.tab-tbl li').on('click', function () {
        $('.tab-tbl li').removeClass('active')
        $(this).addClass('active')
    });
    $('.show-b-more').on('click', function () {
        $('.box-more').toggleClass('scroll-more')
        if ($('.box-more').hasClass('scroll-more')) {
            $('.show-b-more span').text('Thu gọn')
            $('.show-b-more svg').toggleClass('rotate')
        } else {
            $('.show-b-more span').text('Xem thêm')
            $('.show-b-more svg').toggleClass('rotate')
        }

    });
    $('.tab-side li').on('click', function () {
        $('.tab-side li').removeClass('active')
        $(this).addClass('active')
    })

    $('.btn-log').prop('disabled', true);


    $('.choose-tab .tab__menu').on('click', function () {
        $('.choose-tab .tab__menu').removeClass('active');
        $(this).addClass('active')
        if($(this).hasClass('active')){
            $('.side-bar-tab').removeClass('small-menu')
        }
        $('.choose-tab .list').addClass('hidden')
        $(this).children('.list').toggleClass('hidden')

    })

    $('.notify').on('click', function () {
        $('.screen').removeClass('hidden')
        $('.sub-nav-notify').toggleClass('activeTb')

    })
    $('.screen').on('click', function () {
        $(this).addClass('hidden')
        $('.sub-nav-notify').toggleClass('activeTb')
    })

    $('.btn-small-menu').on('click', function () {
        $('.side-bar-tab').toggleClass('small-menu')
    })
})

// MENU




