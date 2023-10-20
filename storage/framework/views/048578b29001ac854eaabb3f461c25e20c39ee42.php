<?php
$lang = App::getLocale();
$currency_info = App\Models\Currency::find(Session::get('currency'));
?>


<?php $__env->startSection('title'); ?>
<?php echo e($child[$lang.'_name']); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="innerTop_section"> 
    <div class="container pxLG-0">
        <h3 class="innerTop__title"><?php echo e($child[$lang.'_name']); ?></h3>
    </div>
</section>

<section class="profile_section mainRelative_section"> 
    <div class="container pxLG-0">
        <div class="row profileinV__row">
            <div class="col-12 col-md-5 col-lg-3">
                <div class="sideBar__menu">
                    <ul class="sideBar__list">
                        <li class="sideBar__item"> 
                            <a href="child_info.html" class="sideBar__link active_link">
                                <img src="<?php echo e(url('interface')); ?>/img/profile-circle.png" alt="" class="profileTH_icon">
                                <span> بطاقة التعريف </span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="study_info.html" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/archive-book.png" alt="" class="profileTH_icon">
                                <span> المعلومات الدراسية </span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="health_info.html" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/archive-book.png" alt="" class="profileTH_icon">
                                <span> المعلومات الصحية </span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="social_info.html" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/task-square.png" alt="" class="profileTH_icon">
                                <span> المعلومات الاجتماعية </span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="reports.html" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/task-square.png" alt="" class="profileTH_icon">
                                <span> التقارير </span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="history.html" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/receipt-text.png" alt="" class="profileTH_icon">
                                <span> سجل التبرع </span>
                            </a>
                        </li>
                        <li class="sideBar__item"> 
                            <a href="make_happy.html" class="sideBar__link">
                                <img src="<?php echo e(url('interface')); ?>/img/wallet.png" alt="" class="profileTH_icon">
                                <span> أفرح يتيمك </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9">
                <div class="profInner_WrapDes">
                    <div class="myInfo__taBorder">
                        <h3 class="myInfo_title"> بطاقة التعريف </h3>
                        <div class="myINForm__Wrapz">
                            <form action="" class="myProInfo__form">
                                <div class="form__row">
                                    <div class="col-12 col-lg-4">
                                        <div class="childIN_thumb">
                                            <img src="<?php echo e(url('interface')); ?>/img/child.png" alt="" class="childIMG_one">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-8">
                                        <div class="innerForm__row">
                                            <div class="col-12 col-lg-6">
                                                <label for="name1" class="profileV__label">  الاسم </label>
                                                <input type="text" class="profileV__input" placeholder=" ابراهيم ">
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="name2" class="profileV__label">  الاسم </label>
                                                <input type="text" class="profileV__input" placeholder=" عبد الله ">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="gender" class="profileV__label">  الجنس </label>
                                        <input type="text" class="profileV__input" placeholder=" ذكر ">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="date" class="profileV__label">  تاريخ الميلاد </label>
                                        <input type="text" class="profileV__input" placeholder= " 05/12/2002 ">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="number" class="profileV__label">  رقم شهادة الميلاد </label>
                                        <input type="text" class="profileV__input" placeholder=" 06548849526 ">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="number" class="profileV__label">  الجنسية </label>
                                        <input type="text" class="profileV__input" placeholder=" سوري ">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="number" class="profileV__label">  الدولة </label>
                                        <input type="text" class="profileV__input" placeholder=" سوريا ">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="number" class="profileV__label">  المحافظة </label>
                                        <input type="text" class="profileV__input" placeholder=" سوريا ">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container inovIcon_container innerPges_containerInv pxLG-0">
        <div class="inovIcon_conOverlay"></div>
        <div class="row cardFlex__end">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="innovForm__card" id="innovForm__card">
                    <ul class="nav nav-pills allInovation__pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#oneInoV__wrapper" data-toggle="tab"> التبرع لمرة واحدة </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#allInov__wrapper" data-toggle="tab"> تبرع دوري </a>
                        </li>
                    </ul>
                    <div class="tab-content"  id="allInovation__tabs">
                        <div class="curr__wrapper tab-pane fade in active show" role="tabpanel" id="oneInoV__wrapper">
                            <form action="" class="innoVchs__form">
                                <h3 class="innoV_title"> اختر المبلغ </h3>
                                <div class="priceFlex_wrap">
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 700$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 2500$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money" checked>
                                        <span class="myNew_Dgradio"> 5,000$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 190$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 250$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 450$ </span>
                                    </div>
                                </div>
                                <div class="innVForm_Group">
                                    <input type="text" class="innVForm_input" placeholder="5,000">
                                    <span class="abs__dollar">usd</span>
                                </div>
                                <select name="category" class="innVForm_select nice-select">
                                    <option value=" اختر التصنيف " selected> اختر التصنيف </option>
                                    <option value=" اختر التصنيف "> اختر التصنيف </option>
                                    <option value=" اختر التصنيف "> اختر التصنيف </option>
                                </select>
                                <button type="submit" class="innvSubmit__btn"> تبرع الان </button>
                            </form>
                        </div>
                        <div class="curr__wrapper tab-pane fade" role="tabpanel" id="allInov__wrapper">
                            <form action="" class="innoVchs__form">
                                <h3 class="innoV_title"> اختر المبلغ </h3>
                                <div class="priceFlex_wrap">
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 700$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 2500$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money" checked>
                                        <span class="myNew_Dgradio"> 5,000$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 190$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 250$ </span>
                                    </div>
                                    <div class="HDVcheck__label">
                                        <input type="radio" class="HDnCh_radio" name="money">
                                        <span class="myNew_Dgradio"> 450$ </span>
                                    </div>
                                </div>
                                <div class="innVForm_Group">
                                    <input type="text" class="innVForm_input" placeholder="5,000">
                                    <span class="abs__dollar">usd</span>
                                </div>
                                <select name="category" class="innVForm_select nice-select">
                                    <option value=" اختر التصنيف " selected> اختر التصنيف </option>
                                    <option value=" اختر التصنيف "> اختر التصنيف </option>
                                    <option value=" اختر التصنيف "> اختر التصنيف </option>
                                </select>
                                <button type="submit" class="innvSubmit__btn"> تبرع الان </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="open__menu innerOpenBtn">
            <img src="<?php echo e(url('interface')); ?>/img/heart.png" alt="" class="inoV_icon">
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('interface.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/Sites/ghars/resources/views/interface/child.blade.php ENDPATH**/ ?>