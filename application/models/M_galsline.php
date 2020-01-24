<?php 

defined('BASEPATH') or exit('NO Direct Script Access Allowed');

class M_galsline extends CI_Model
{
  function edit_data($where, $table)
  {
    return $this->db->get_where($table, $where);
  }

  function get_data($table)
  {
    return $this->db->get($table);
  }

  function insert_data($data, $table)
  {
    $this->db->insert($table, $data);
  }

  function update_data($table, $data, $where)
  {
    $this->db->update($table, $data, $where);
  }

  function delete_data($where, $table)
  {
    $this->db->where($where);
    $this->db->delete($table);
  }

  public function kode_tranfer()
  {
    $this->db->select('right(no_pemesanan,3) as kode', false);
    $this->db->order_by('no_pemesanan', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('pemesanan');
    if ($query->num_rows() > 0) {
      $data = $query->row_array();
      $kode = intval($data['kode']) + 1;

    } else {
      $kode = 1;
    }

    $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
    $tgl = date('ym');
    $kodePemesanan = "P" . $tgl . $kodemax;

    return $kodePemesanan;

  }

  public function kode_pembayaran($id_member)
  {
    $this->db->select('right(no_pembayaran, 3) as kode', false);
    $this->db->order_by('no_pembayaran', 'desc');
    $this->db->limit(1);
    $query = $this->db->get('pembayaran');
    if ($query->num_rows() > 0) {
      $data = $query->row_array();
      $kode = intval($data['kode']) + 1;
    } else {
      $kode = 1;
    }

  $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
  $tgl = date('ym');
  $kodePembayaran = "PB".$id_member."-"."$tgl".$kodemax;

  return $kodePembayaran;
  }

}
?>

 