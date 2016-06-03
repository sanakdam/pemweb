<?php
/**
 * Created by PhpStorm.
 * User: san
 * Date: 6/2/16
 * Time: 8:28 PM
 */

namespace App\Http\Controllers;


use App\Report;

class ReportController extends Controller
{
    public function getReport() {
        $reports = Report::orderBy('created_at', 'desc')->get();
        return view('admin.report', compact('reports'));
    }

    public function getDeleteReport($report_id) {
        $report = Report::where('id', $report_id)->first();
        $report->delete();
        return redirect()->back();
    }
}