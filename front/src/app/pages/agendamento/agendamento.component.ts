import { Component, OnInit, ViewChild } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import {
  PoComboOption,
  PoModalAction,
  PoModalComponent,
  PoNotificationService,
  PoPageAction,
  PoRadioGroupOption,
  PoTableColumn,
} from '@po-ui/ng-components';
import { AutorizacaoAgendaService } from 'src/app/services/autorizacao.service';
import { PessoaService } from 'src/app/services/pessoa.service';
import { PortariaService } from 'src/app/services/portaria.service';
import { VeiculoService } from 'src/app/services/veiculo.service';

@Component({
  selector: 'app-agendamento',
  templateUrl: './agendamento.component.html',
  styleUrls: ['./agendamento.component.css'],
})
export class AgendamentoComponent implements OnInit {
  apiUrl = 'http://localhost:8000/api/autoriza_agenda';
  constructor(
    private service: AutorizacaoAgendaService,
    private pessoaService: PessoaService,
    private veiculoService: VeiculoService,
    private portariaService: PortariaService,
    private notification: PoNotificationService
  ) {}
  @ViewChild('modal', { static: true })
  modal!: PoModalComponent;
  form = new FormGroup({
    id_pessoa_autoriza: new FormControl(),
    id_pessoa_entrada: new FormControl(),
    observacao: new FormControl(''),
    hora_data: new FormControl(),
    id_veiculo: new FormControl(),
    id_portaria: new FormControl(),
  });
  pessoas: PoComboOption[] = [];
  veiculos: PoComboOption[] = [];
  portarias: PoComboOption[] = [];
  id_linha!: number;
  index!: number;
  id!: number | undefined;
  actions: PoPageAction[] = [
    {
      label: 'Nova Autorização',
      action: () => {
        this.title = 'Cadastrar';
        this.form.reset();
        this.modal.open();
      },
    },
  ];
  columns: PoTableColumn[] = [
    {
      label: ' ',
      property: 'edit',
      width: '93px',
      sortable: false,
      type: 'cellTemplate',
    },
    {
      label: 'ID',
      property: 'id',
      sortable: true,
      type: 'string',
    },
    {
      label: 'Autorizado por',
      property: 'id_pessoa_autoriza',
      sortable: true,
      type: 'string',
    },
    {
      label: 'Pessoa',
      property: 'id_pessoa_entrada',
      sortable: true,
      type: 'string',
    },
    {
      label: 'Observação',
      property: 'observacao',
      sortable: true,
      type: 'string',
    },
    {
      label: 'Data',
      property: 'hora_data',
      sortable: true,
      type: 'date',
    },
    {
      label: 'Veículo',
      property: 'id_veiculo',
      sortable: true,
      type: 'string',
    },
    {
      label: 'Portaria',
      property: 'id_portaria',
      sortable: true,
      type: 'string',
    },
  ];
  tipo: PoRadioGroupOption[] = [
    {
      label: 'Autorização',
      value: 1,
    },
    {
      label: 'Agendamento',
      value: 0,
    },
  ];
  items: any[] = [];
  title = 'Cadastrar';
  loading = false;
  conteudo = 'agendamento';

  ngOnInit() {
    this.loading = true;
    this.limparDados();
    this.pessoaService.get().subscribe({
      next: (data) => {
        let res = Object(data).data;
        if (res) {
          for (let i = 0; i < Object(res).length; i++) {
            this.pessoas.push({
              label: Object(res)[i].nome,
              value: Object(res)[i].id,
            });
          }
          this.pessoas = [...this.pessoas];
        }
        return;
      },
      error: (err) => {
        this.notification.error('Erro');
        return;
      },
    });
    this.veiculoService.get().subscribe({
      next: (data) => {
        let res = Object(data).data;
        if (res) {
          for (let i = 0; i < Object(res).length; i++) {
            this.veiculos.push({
              label: Object(res)[i].placa,
              value: Object(res)[i].id,
            });
          }
          this.veiculos = [...this.veiculos];
        }
        return;
      },
      error: (err) => {
        this.notification.error('Erro');
        return;
      },
    });
    this.portariaService.get().subscribe({
      next: (data) => {
        let res = Object(data).data;
        if (res) {
          for (let i = 0; i < Object(res).length; i++) {
            this.portarias.push({
              label: Object(res)[i].portaria_nome,
              value: Object(res)[i].id,
            });
          }
          this.portarias = [...this.portarias];
        }
        return;
      },
      error: (err) => {
        this.notification.error('Erro');
        return;
      },
    });
    this.service.get().subscribe({
      next: (data) => {
        let res = Object(data).data;
        if (res) {
          this.index = Object(res).length;
          for (let i = 0; i < Object(res).length; i++) {
            this.items.push({
              id: Object(res)[i].id,
              id_pessoa_autoriza: this.pessoas.find(
                (pessoa) => pessoa.value === Object(res)[i].id_pessoa_autoriza
              )?.label,
              id_pessoa_entrada: this.pessoas.find(
                (pessoa) => pessoa.value === Object(res)[i].id_pessoa_entrada
              )?.label,
              observacao: Object(res)[i].observacao,
              hora_data: Object(res)[i].hora_data,
              id_veiculo: this.veiculos.find(
                (veiculo) => veiculo.value === Object(res)[i].id_veiculo
              )?.label,
              id_portaria: this.portarias.find(
                (portaria) => portaria.value === Object(res)[i].id_portaria
              )?.label,
              tipo_autorizacao_agenda:
                Object(res).tipo_autorizacao_agenda === 1
                  ? 'Autorização'
                  : 'Agendamento',
            });
          }
          this.items = [...this.items];
        }
        this.loading = false;
        return;
      },
      error: (err) => {
        this.notification.error('Erro');
        return;
      },
    });
  }
  limparDados() {
    this.pessoas = [];
    this.veiculos = [];
    this.portarias = [];
    this.items = [];
  }
  fecharModal(page: string) {
    this.id = undefined;
    this.form.reset();
    this.modal.close();
  }
  salvar(id?: number) {
    if (id) {
      this.atualizar(id);
    } else {
      this.processar();
    }
  }
  editar(id: number) {
    this.title = 'Atualizar';
    this.id = id;
    let row = this.items.find((item) => item.id === id);
    console.log()
    this.form.patchValue({
      id_pessoa_autoriza: this.pessoas.find(
        (pessoa) => pessoa.label === row.id_pessoa_autoriza
      )?.value,
      id_pessoa_entrada: this.pessoas.find(
        (pessoa) => pessoa.label === row.id_pessoa_entrada
      )?.value,
      observacao: row.observacao,
      hora_data: row.hora_data,
      id_veiculo: this.veiculos.find(
        (veiculo) => veiculo.label === row.id_veiculo
      )?.value,
      id_portaria: this.portarias.find(
        (portaria) => portaria.label === row.id_portaria
      )?.value,
    });
    this.modal.open();
  }
  selecionado(id: number) {
    this.id_linha = id;
  }
  apagar(id: number) {
    this.excluir(id);
  }
  private atualizar(id: number) {
    if (!this.form.valid) {
      return;
    } else {
      this.loading = true;
      setTimeout(() => {
        this.loading = false;
        this.service.put(id, this.form.value).subscribe({
          error: (err) => {
            this.notification.error('Erro');
            return;
          },
          next: () => {
            this.notification.success('Sucesso');
            this.fecharModal('autorizacao');
            window.location.reload();
            return;
          },
        });
      }, 700);
    }
  }
  private processar() {
    if (!this.form.valid) {
      return;
    } else {
      this.loading = true;
      setTimeout(() => {
        this.loading = false;
        this.service.post(this.form.value).subscribe({
          error: (err) => {
            this.notification.error('Erro');
            return;
          },
          next: () => {
            this.notification.success('Sucesso');
            this.fecharModal('autorizacao');
            window.location.reload();
            return;
          },
        });
      }, 700);
    }
  }
  private excluir(id: number) {
    this.loading = true;
    setTimeout(() => {
      this.loading = false;
      this.service.delete(id).subscribe({
        error: (err) => {
          this.notification.error('Erro');
          return;
        },
        next: () => {
          this.notification.success('Sucesso');
          this.fecharModal;
          window.location.reload();
          return;
        },
      });
    }, 700);
  }
}
