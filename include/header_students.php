<?$arGroupAvalaibleAdmin = array(1);
$arGroups = CUser::GetUserGroup($USER->GetID());
$result_intersect_admin = array_intersect($arGroupAvalaibleAdmin, $arGroups);?>

<header class="students">
	<div class="header__top wrapper">
	<? //echo var_dump($result_intersect_admin); ?>
		<? if (!empty($result_intersect_admin)) { ?>
			<a href="/" class="logo">
				<div class="logo__image"></div>
				<div class="logo__title">Академия Современного Образования</div>
			</a>
		<? }  elseif (empty($result_intersect_admin)) { ?>
			<a href="/tests/" class="logo">
				<div class="logo__image"></div>
				<div class="logo__title">Академия Современного Образования</div>
			</a>
		<? } ?>
		<div class="header__top--right">
			<ul class="header__menu">
				<li><a href="/tests/#tests" onclick="smoothToBlock()">Тесты</a></li>
				<li><a href="/tests/#results" onclick="smoothToBlock()">Результаты</a></li>
			</ul>
			<!-- <div class="header__search"></div> -->
			<form action="<?=$arResult["AUTH_URL"]?>">
				<?foreach ($arResult["GET"] as $key => $value):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
				<?endforeach?>
				<input type="hidden" name="logout" value="yes" />
				<button type="submit" name="logout_butt" class="header__btn btn logout">Выход</button>
			</form>
		</div>
	</div>
	<div class="header__content">
		<div class="inner-wrap">
			<h1>ДИСТАНЦИОННОЕ ОБУЧЕНИЕ</h1>
			<p>&laquo;Академия Современного Образования&raquo; проводит дистанционное обучение по&nbsp;курсам</p>
		</div>
	</div>
</header>