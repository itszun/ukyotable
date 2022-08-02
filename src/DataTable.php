<?php
namespace ZunFuyuzora\UkyoTable;

class DataTable {

    public function keyword() {
        //
    }

    public function compile($data)
    {
        $nomor_urut = $this->start + 1;
        foreach ($data as $row) {
            $actionBtn = '
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm"  dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">Action <i class="fa fa-caret-down" style="margin-left:5px;"></i></button>

                <div class="dropdown-menu" role="menu" style="">';
            $actionBtn = $actionBtn . '
                    <a class="dropdown-item" href="' . route('admin.banners.edit', $row->id) . '"><i class="fa fa-edit" style="margin-right:5px;"></i>Edit</a>';
            $actionBtn = $actionBtn . '
                    </div>
            </div>';
            $output['data'][] = array(
                $nomor_urut, formatDatetime($row->created_at), $actionBtn
            );
            $nomor_urut++;
        }
        return response()->json($output);
    }
}

//

///

/**
 * use ZunFuyuzora/UkyoTable/DataTable
 *
 * DataTable::query()
 *
 */
