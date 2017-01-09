<?php

namespace donatj;

/**
 * Simple Calendar
 *
 * @author Jesse G. Donat <donatj@gmail.com>
 * @link http://donatstudios.com
 * @license http://opensource.org/licenses/mit-license.php
 *
 */
	
class SimpleCalendar {
	
	protected static $EST_MONTHS = [
		1  => "Jaanuar",
		2  => "Veebruar",
		3  => "Märts",
		4  => "Aprill",
		5  => "Mai",
		6  => "Juuni",
		7  => "Juuli",
		8  => "August",
		9  => "September",
		10 => "Oktoober",
		11 => "November",
		12 => "Detsember",
	];
	
	
	/**
	 * Array of Week Day Names
	 *
	 * @var array
	 */
	public $wday_names = ['Pühapäev' , 'Esmaspäev', 'Teisipäev', 'Kolmapäev', 'Neljapäev', 'Reede', 'Laupäev'];

	private $now = false;
	private $daily_html = array();
	private $offset = 0;
	
	protected $month = 1;
	protected $year = 1970;

	/**
	 * Constructor - Calls the setDate function
	 *
	 * @see setDate
	 * @param null|string $date_string
	 */
	function __construct( $year = null, $month = null ) {		
		$this->month = empty($month) ? date('m') : $month;
		$this->year = empty($year) ? date('Y') : $year;
		$this->setDate($this->year .'-'. $this->month .'-01');
		$this->setStartOfWeek(1);
	}

	/**
	 * Sets the date for the calendar
	 *
	 * @param null|string $date_string Date string parsed by strtotime for the calendar date. If null set to current timestamp.
	 */
	public function setDate( $date_string = null ) {
		if( $date_string ) {
			$this->now = getdate(strtotime($date_string));
		} else {
			$this->now = getdate();
		}
	}

	/**
	 * Add a daily event to the calendar
	 *
	 * @param string      $html The raw HTML to place on the calendar for this event
	 * @param string      $start_date_string Date string for when the event starts
	 * @param null|string $end_date_string Date string for when the event ends. Defaults to start date
	 */
	public function addDailyHtml( $html, $start_date_string, $end_date_string = null ) {
		static $htmlCount = 0;
		$start_date = strtotime($start_date_string);
		if( $end_date_string ) {
			$end_date = strtotime($end_date_string);
		} else {
			$end_date = $start_date;
		}

		$working_date = $start_date;
		do {
			$tDate = getdate($working_date);
			$working_date += 86400;
			$this->daily_html[$tDate['year']][$tDate['mon']][$tDate['mday']][$htmlCount] = $html;
		} while( $working_date < $end_date + 1 );

		$htmlCount++;

	}

	/**
	 * Clear all daily events for the calendar
	 */
	public function clearDailyHtml() { $this->daily_html = array(); }

	/**
	 * Sets the first day of the week
	 *
	 * @param int|string $offset Day to start on, ex: "Monday" or 0-6 where 0 is Sunday
	 */
	public function setStartOfWeek( $offset ) {
		if( is_int($offset) ) {
			$this->offset = $offset % 7;
		} else {
			$this->offset = date('N', strtotime($offset)) % 7;
		}
	}

	/**
	 * Returns/Outputs the Calendar
	 *
	 * @param bool $echo Whether to echo resulting calendar
	 * @return string HTML of the Calendar
	 */
	public function show( $echo = true ) {
	
		if( $this->wday_names ) {
			$wdays = $this->wday_names;
		} else {
			$today = (86400 * (date("N")));
			for( $i = 0; $i < 7; $i++ ) {
				$wdays[] = strftime('%a', time() - $today + ($i * 86400));
			}
		}
		
		$this->array_rotate($wdays, $this->offset);
		$wday    = date('N', mktime(0, 0, 1, $this->now['mon'], 1, $this->now['year'])) - $this->offset;
		$no_days = cal_days_in_month(CAL_GREGORIAN, $this->now['mon'], $this->now['year']);
		

		$getmonth = static::$EST_MONTHS[$this->now['mon']];
		$getyear = $this->now['year'];
		
		$next = [];
		$nm = $this->get_next_month($this->month, $this->year);
		

		foreach ($nm as $unit => $value) {
			$next[] = $unit.'='.$value;
		}
		$next = 'user.php?'. implode('&amp;', $next);
		/*var_dump($next);
		var_dump($nm, $this->month);*/
		
		$prev = [];
		$pm = $this->get_prev_month($this->month, $this->year);
		foreach ($pm as $unit => $value) {
			$prev[] = $unit.'='.$value;
		}
		$prev = 'user.php?'. implode('&amp;', $prev);
		
		
		$out = '<b><a href="'.$prev.'"><span class= "glyphicon glyphicon-arrow-left style="font-size: 250%""></span>Eelmine kuu</a><font size="4"> &#8194'.$getmonth.' '.$getyear.' &#8194 </font><a href="'. $next .'">Järgmine kuu <span class= "glyphicon glyphicon-arrow-right style="font-size: 250%""></span></a></b>';
		$out .= '<br>';
		$out .= '<table cellpadding="0" cellspacing="0" class="SimpleCalendar"><thead><tr>';

		for( $i = 0; $i < 7; $i++ ) {
			$out .= '<th>' . $wdays[$i] . '</th>';
		}

		$out .= "</tr></thead>\n<tbody>\n<tr>";

		$wday = ($wday + 7) % 7;

		if( $wday == 7 ) {
			$wday = 0;
		} else {
			$out .= str_repeat('<td class="SCprefix" style= "background: white;">&nbsp;</td>', $wday);
		}

		$count = $wday + 1;
		for( $i = 1; $i <= $no_days; $i++ ) {
			$out .= '<td' . ($i == $this->now['mday'] && $this->now['mon'] == date('n') && $this->now['year'] == date('Y') ? ' class="today" style="background: #d2d2d2;"' : '') . '>';

			$datetime = mktime(0, 0, 1, $this->now['mon'], $i, $this->now['year']);

			$out .= '<time datetime="' . date('Y-m-d', $datetime) . '"> <a href="user.php?m='.$this->month.'&y='.$this->year.'&date='.$i.'&month='.$getmonth.'&year='.$getyear.'" style="text-decoration:none"><font size="4">' . $i . '</font></a></time>';

			$dHtml_arr = false;
			if( isset($this->daily_html[$this->now['year']][$this->now['mon']][$i]) ) {
				$dHtml_arr = $this->daily_html[$this->now['year']][$this->now['mon']][$i];
			}

			if( is_array($dHtml_arr) ) {
				foreach( $dHtml_arr as $dHtml ) {
					$out .= '<div class="event" style = "color: #355; font-size: .65em; padding: 5px; line-height: 1em;  border-bottom: 1px solid #bbb; background: #858585;  color: white" >' . $dHtml . '</div>';
				}
			}

			$out .= "</td>";

			if( $count > 6 ) {
				$out .= "</tr>\n" . ($i != $count ? '<tr>' : '');
				$count = 0;
			}
			$count++;
		}
		$out .= ($count != 1 ? str_repeat('<td class="SCsuffix" style= "background: white;">&nbsp;</td>', 8 - $count) : '') . "</tr>\n</tbody></table>\n";
		if( $echo ) {
			echo $out;
		}

		return $out;
	}

	private function array_rotate( &$data, $steps ) {
		$count = count($data);
		if( $steps < 0 ) {
			$steps = $count + $steps;
		}
		$steps = $steps % $count;
		for( $i = 0; $i < $steps; $i++ ) {
			array_push($data, array_shift($data));
		}
	}
	
	protected function get_next_month($month, $year) {
		
		// the date doesn't exist
		if (false === checkdate(1, $month, $year)) {
			return;
			// TODO handle wrong date, e.g. let explode the side or something
		}
		
		$next_month = $month + 1;
		$next_year = $year;
		
		if ($next_month > 12) {
			$next_month = 1;
			$next_year++;
		}
		
		return [
			'm' => $next_month,
			'y' => $next_year,
		];
	}
	
	
	protected function get_prev_month($month, $year) {
		
		// the date doesn't exist
		if (false === checkdate(1, $month, $year)) {
			return;
			// TODO handle wrong date, e.g. let explode the side or something
		}
		
		$prev_month = $month - 1;
		$prev_year = $year;
		
		if ($prev_month < 1) {
			$prev_month = 12;
			$prev_year--;
		}
		
		return [
			'm' => $prev_month,
			'y' => $prev_year,
		];
	}
}


/*const MONDAY = 1;
$_GET = [
	'y' => 2017,
	'm' => 1,
];
$calendar = new SimpleCalendar($_GET['y'], $_GET['m'])
//$calendar = new SimpleCalendar($_GET['y']. '-'.$_GET['m'].'-01');
$calendar->setStartOfWeek(MONDAY);
$calendar->show();*/
