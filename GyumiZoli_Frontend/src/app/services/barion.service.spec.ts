import { TestBed } from '@angular/core/testing';

import { BarionService } from './barion.service';

describe('BarionService', () => {
  let service: BarionService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(BarionService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
