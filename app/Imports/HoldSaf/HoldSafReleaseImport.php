<?php

namespace App\Imports\HoldSaf;

use App\Models\HoldSaf\HoldSafModel;
use App\Models\HoldSaf\ReleasedByModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class HoldSafReleaseImport implements ToCollection, WithHeadingRow, WithCalculatedFormulas, WithEvents, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures, RegistersEventListeners;

    /**
     * Transform a date value into a Carbon object.
     *
     * @return \Carbon\Carbon|null
     */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        date_default_timezone_set("Asia/Jakarta");
        foreach ($rows as $row) {
            $data = HoldSafModel::where('id', $row['id'])
            ->update([
                'released_by' => $row['released_by'],
                'alasan_release' => $row['alasan_release'],
                'tanggal_release' => $this->transformDate($row['tanggal_release']),
                'status' => 'CLOSED-DONE',
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            // Can also use callback validation rules
            '*.matchingkey' => ['required', Rule::exists('holdsaf', 'matchingkey')],
            '*.released_by' => function($attribute, $value, $onFailure) {
                if ($value == NULL) {
                    $onFailure('RELEASE BY Kosong');
                }
              }, 
              '*.alasan_release' => function($attribute, $value, $onFailure) {
                if ($value == NULL) {
                    $onFailure('ALASAN RELEASE Kosong');
                }
            },
            '*.tanggal_release' => function($attribute, $value, $onFailure) {
                if ($value == NULL) {
                    $onFailure('TANGGAL RELEASE Kosong');
                }
            },
            '*.id' => function($attribute, $parameters, $onFailure) {
                $holdSaf = HoldSafModel::find($parameters);
                if ($holdSaf->status == 'CLOSED-DONE') {
                    $onFailure('Data Sudah Pernah Di Release Tanggal '.$holdSaf->tanggal_release);
                }
            }
        ];
    }
}
