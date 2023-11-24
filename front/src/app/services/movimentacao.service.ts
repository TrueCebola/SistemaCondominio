import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class MovimentacaoService {
  apiUrl = 'http://localhost:8000/api/movimentacao';
  constructor(private http: HttpClient) {}

  get() {
    return this.http.get(this.apiUrl);
  }
  // async exemplo1() {
  //   const response = await fetch('http://localhost:8000/api/movimentacao', {
  //     method: 'GET',
  //   });
  //   const data = await response.json();
  //   return data;
  // }
  // exemplo2() {
  //   fetch('http://localhost:8000/api/movimentacao', {
  //     method: 'GET',
  //   })
  //     .then((response) => response.json())
  //     .then((data) => console.log(data));
  // }
  post(movimentacao: any) {
    return this.http.post(this.apiUrl, movimentacao);
  }
  put(id: number, movimentacao: any) {
    let url = `${this.apiUrl}/${id}`;
    return this.http.put(url, movimentacao);
  }
  delete(id: number) {
    let url = `${this.apiUrl}/${id}`;
    return this.http.delete(url);
  }
}
