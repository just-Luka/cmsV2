<?php

namespace App\Libs;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\App;
use Mockery\Exception;

class Date
{
	public $lang;

	private $month_ka = [
		1 => "იანვარი",
		2 => "თებერვალი",
		3 => "მარტი",
		4 => "აპრილი",
		5 => "მაისი",
		6 => "ივნისი",
		7 => "ივლისი",
		8 => "აგვისტო",
		9 => "სექტემბერი",
		10 => "ოქტომბერი",
		11 => "ნოემბერი",
		12 => "დეკემბერი"
	];

	private $formattedMonth_ka = [
		1 => "იანვრის",
		2 => "თებერვლის",
		3 => "მარტის",
		4 => "აპრილის",
		5 => "მაისის",
		6 => "ივნისის",
		7 => "ივლისის",
		8 => "აგვისტოს",
		9 => "სექტემბრის",
		10 => "ოქტომბრის",
		11 => "ნოემბრის",
		12 => "დეკემბრის"
	];

	private $month_en = [
		1 => "January",
		2 => "February",
		3 => "March",
		4 => "April",
		5 => "May",
		6 => "June",
		7 => "July",
		8 => "August",
		9 => "September",
		10 => "October",
		11 => "November",
		12 => "December"
	];

	private $month_de = [
		1 => "January",
		2 => "February",
		3 => "March",
		4 => "April",
		5 => "May",
		6 => "June",
		7 => "July",
		8 => "August",
		9 => "September",
		10 => "October",
		11 => "November",
		12 => "December"
	];

	private $month_ru = [
		1 => "Январь",
		2 => "Февраль",
		3 => "Март",
		4 => "Апрель",
		5 => "Май",
		6 => "Июнь",
		7 => "Июль",
		8 => "Август",
		9 => "Сентябрь",
		10 => "Октябрь",
		11 => "Ноябрь",
		12 => "Декабрь"
	];

	private $week_ka = [
		1 => "ორშაბათი",
		2 => "სამშაბათი",
		3 => "ოთხშაბათი",
		4 => "ხუთშაბათი",
		5 => "პარასკევი",
		6 => "შაბათი",
		0 => "კვირა",
	];

	private $week_en = [
		1 => "Monday",
		2 => "Tuesday",
		3 => "Wednesday",
		4 => "Thursday",
		5 => "Friday",
		6 => "Saturday",
		0 => "Sunday",
	];

	private $week_de = [
		1 => "Monday",
		2 => "Tuesday",
		3 => "Wednesday",
		4 => "Thursday",
		5 => "Friday",
		6 => "Saturday",
		0 => "Sunday",
	];

	private $week_ru = [
		1 => "Понедельник",
		2 => "Вторник",
		3 => "Среда",
		4 => "Четверг",
		5 => "Пятница",
		6 => "Субота",
		0 => "Воскресенье",
	];

	private $shortWeek_ka = [
		0 => 'Sun',
		1 => 'Mon',
		2 => 'Tue',
		3 => 'Wed',
		4 => 'Thu',
		5 => 'Fri',
		6 => 'Sat',
	];

	private $shortWeek_en = [
		0 => 'Sun',
		1 => 'Mon',
		2 => 'Tue',
		3 => 'Wed',
		4 => 'Thu',
		5 => 'Fri',
		6 => 'Sat',
	];

	private $shortWeek_ru = [
		0 => 'Вос',
		1 => 'Пон',
		2 => 'Вто',
		3 => 'Сре',
		4 => 'Чет',
		5 => 'Пят',
		6 => 'Суб',
	];

	/**
	 * @return $this
	 */
	public function getInstance()
	{
		return $this;
	}

    /**
     * @param $date
     * @return string
     */
	public function getDay($date)
	{
		return Carbon::parse($date)->format('d');
	}

	/**
	 * @param $date
	 * @param $lang
	 * @return mixed
	 */
	public function getMonthString($date, $lang)
	{
		$month = ltrim(Carbon::parse($date)->format('m'), 0);
		return $this->{'month_' . $lang}[$month];
	}

	/**
	 * @param $index
	 * @param $lang
	 * @return mixed
	 */
	public function getMonthByIndex($index, $lang)
	{
		return $this->{'month_' . $lang}[$index];
	}

	/**
	 * @param $date
	 * @param $lang
	 * @return string
	 */
	public function getFormattedMonthString($date, $lang)
	{
		$month = ltrim(Carbon::parse($date)->format('m'), 0);
		return $this->formattedMonth_ge[$month];
	}

	/**
	 * @param $date
	 * @param $lang
	 * @return string
	 */
	public function getShortMonthString($date, $lang)
	{
		$month = ltrim(Carbon::parse($date)->format('m'), 0);
		return str_limit($this->{'month_' . $lang}[$month], 3, '');
	}

	/**
	 * @param $date
	 * @return string
	 */
	public function getMonth($date)
	{
		$month = Carbon::parse($date)->format('m');
		return $month;
	}

	/**
	 * @param $date
	 * @param $lang
	 * @return mixed
	 */
	public function getLongMonth($date, $lang)
	{
		$month = Carbon::parse($date)->format('F');

		return $this->{'month_' . $lang}[$month];
	}

	/**
	 * @param $date
	 * @return string
	 */
	public function getHourMinute($date)
	{
		return Carbon::parse($date)->format('H');
	}

	/**
	 * @param $date
	 * @return string
	 */
	public function getYear($date)
	{
		return Carbon::parse($date)->format('Y');
	}

	/**
	 * @param $date
	 * @param $lang
	 * @return mixed
	 */
	public function shortWithoutYear($date, $lang)
	{
		$month = ltrim(Carbon::parse($date)->format('m'), 0);
		return $this->{'month_' . $lang}[$month];
	}

	/**
	 * @param $lang
	 * @param $startYear
	 * @param null $endYear
	 * @param bool $startFromBig
	 * @return array
	 */
	public function getYearListWithMonth($lang, $startYear, $endYear = null, $startFromBig = false)
	{
		$date = new Date();
		$yearRange = $date->getYearList($startYear, $endYear, $startFromBig);
		$years = [];
		foreach ($yearRange as $year) {
			$monthRange = $date->getMonthList($lang);
			foreach ($monthRange as $key => $month) {
				$key = leadingZero($key);
				$years[$key . '/' . $year] = $month . ' ' . $year;
			}
		}
		return $years;
	}

	/**
	 * @param $startYear
	 * @param null $endYear
	 * @param bool $startFromBig
	 * @return array
	 */
	public function getYearList($startYear, $endYear = null, $startFromBig = false)
	{
		if (empty($endYear)) {
			$endYear = date("Y");
		}
		$yearRange = range($startYear, $endYear);
		if ($startFromBig == true) {
			$yearRange = array_reverse($yearRange);
		}
		return $yearRange;
	}


	/**
	 * @param $lang
	 * @param bool $withoutKeys
	 * @return array
	 */
	public function getMonthList($lang, $withoutKeys = false)
	{
		if ($lang == "abk") {
			$lang = "geo";
		}

		if ($withoutKeys == true) {
			return array_values($this->{"month_" . $lang});
		}
		return $this->{"month_" . $lang};
	}

	/**
	 * @param $lang
	 * @param bool $withoutKeys
	 * @return array
	 */
	public function getWeekList($lang, $withoutKeys = false)
	{
		if ($lang == "abk") {
			$lang = "geo";
		}

		if ($withoutKeys == true) {
			return array_values($this->{"week_" . $lang});
		}
		return $this->{"week_" . $lang};
	}

	/**
	 * @param string $startDay
	 * @param string $endDay
	 * @return array
	 */
	public function getDayList($startDay = "", $endDay = "")
	{
		if (empty($endYear)) {
			$startDay = 1;
		}
		if (empty($endYear)) {
			$endDay = 31;
		}
		return range($startDay, $endDay);
	}

	/**
	 * @param $str
	 * @return bool
	 */
	public function isDate($str, $format = 'Y-m-d')
	{
		$d = DateTime::createFromFormat($format, $str);
		return $d && $d->format($format) == $str;
	}

	/**
	 * @param $date
	 * @param string $template
	 * @return string
	 * @throws \Exception
	 */
	public function getDateTemplate($lang, $date, $template = 'standart', $format = 'Y-m-d')
	{
		if ($this->isDate($date, $format)) {
			if ($template == 'standart') {
				$day = ltrim($this->getDay($date), 0);
				$month = $this->getMonthString($date, $lang);
				$year = $this->getYear($date);
				return $day . ' ' . $month . ', ' . $year;
			} elseif ($template == 'dotted') {
				$day = ltrim($this->getDay($date), 0);
				$month = $this->getMonthString($date, $lang);
				$year = $this->getYear($date);
				return $day . '.' . $month . '.' . $year;
			} elseif ($template == 'dottedMonthNumber') {
				$day = $this->getDay($date);
				$month = $this->getMonth($date);
				$year = $this->getYear($date);
				return $day . '.' . $month . '.' . $year;
			} elseif ($template == 'withWeekDay') {
				$day = $this->getDay($date);
				$week = $this->getWeek($date, $lang);
				$month = $this->getMonthString($date, $lang);
				return $week . ' - ' . $day . ' ' . $month;
			} elseif ($template == 'withoutYear') {
				$day = $this->getDay($date);
				$month = $this->getMonthString($date, $lang);
				return $day . ' ' . $month;
			} elseif ($template == 'shortWithoutYear') {
				$day = $this->getDay($date);
				$month = $this->shortWithoutYear($date, $lang);
				return $day . ' ' . $month;
			} elseif ($template == 'TenderDate') {
				$day = $this->getDay($date);
				$month = $this->shortWithoutYear($date, $lang);
				$year = $this->getYear($date);
				//$hourMinute = $this->getHourMinute($date);
				return $day . ' ' . $month . ', ' . $year;
			} else {
				throw new \Exception(__METHOD__ . ': Unknown date template');
			}
		} else {
			throw new \Exception(__METHOD__ . ': Unknown date format');
		}
	}

	/**
	 * @param $date
	 * @param string $format
	 * @return string
	 * @throws \Exception
	 */
	public function dateToDbFormat($date, $format = 'd/m/Y')
	{
		if (empty($date)) {
			exceptionLog('error', __METHOD__ . ' - date is empty');
		}
		return Carbon::createFromFormat($format, $date)->format('Y-m-d');
	}

	/**
	 * @param $request
	 * @return string
	 * @throws \Exception
	 */
	public function formatDate($request)
	{
		if (!empty($request['year']) && !empty($request['month']) && !empty($request['day'])) {
			return Carbon::parse($request['year'] . '-' . $request['month'] . '-' . $request['day'])->format('Y-m-d');
		} else {
			throw new \Exception(__METHOD__ . ': Empty variables: day,month,year');
		}
	}

	/**
	 * @param $timestamp
	 * @return false|string
	 */
	public function convertTimestampToDate($timestamp, $format = "Y-m-d H:i:s")
	{
		return date($format, $timestamp);
	}

	/**
	 * @param array $value
	 * @return string
	 */
	public function convertArrayToDate(array $value)
	{
		$day = Carbon::createFromFormat('d/m/Y', $value['day']);
		$day = Carbon::parse($day)->format('Y-m-d');
		return $day . ' ' . $value['hour'] . ':' . $value['minute'] . ':00';
	}

	/**
	 * @param $lang
	 * @return mixed
	 */
	public function getShortWeek($lang)
	{
		$dayOfTheWeek = Carbon::now()->dayOfWeek;
		return $this->{'shortWeek_' . $lang}[$dayOfTheWeek];
	}

	/**
	 * @param $lang
	 * @return mixed
	 */
	public function getWeek($date, $lang)
	{
		$dayOfTheWeek = Carbon::parse($date)->dayOfWeek;
		return $this->{'week_' . $lang}[$dayOfTheWeek];
	}


}
