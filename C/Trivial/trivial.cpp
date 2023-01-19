#include <stdio.h>
#include <conio.h>
#include <string.h>
#include <ctype.h>
#include <stdlib.h>
#include <libre.h>
#include <time.h>
#include <graphics.h>

int sw = 0;
int acceso = 0;
int i;
int j;
int k;
char usuario[50];
int administrador = 0;
int aciertos = 0;
int fallos = 0;

struct Preguntas {
	int id;
	char pregunta[100];
	char correcta[100];
	char falsa1[100];
	char falsa2[100];
	char falsa3[100];
} preg;

struct Jugadores{
	char nick[50];
	char mail[100];
	char pass[50];
	char dir[100];
	char tlf[11];
	int edad;
	int admin;
}jug;

struct Partidas{
	int id;
	char nick[50];
	int punt;
}part;

FILE *f;
FILE *l;
FILE *p;
char cadena[50];
int identificador;

void portada() {
	/* Requiere auto detección */
	int gdriver = DETECT, gmode, errorcode;
	int midx, midy;
	int radius = 230;
	int izq, ar, der, ab;
	int i;

	/* Inicializa las variables locales y los graficas */
	initgraph(&gdriver, &gmode, "t:\\bgi");

	/* Lee el resultado de la inicialización */
	errorcode = graphresult();
	if (errorcode != grOk) { /* Si ocurre algún error */
		printf("Error grafico: %s \n", grapherrormsg(errorcode));
		printf("Presionar una tecla para salir:");
		getch();
		exit(1); /* Codigo de error */
	}

	midx = getmaxx()/2;
	midy = getmaxy()/2;
	setcolor(getmaxcolor());

	fillellipse (midx, midy, radius, radius);
	
	setcolor(1);
	izq = 165;
	ar = 70;
	der = 310;
	ab = 230;
	for (i = 0; i < 100; i++) {
		rectangle (izq, ar, der, ab);
		izq++;
		ar++;
		der--;
		ab--;
	}
	
	setcolor(4);
	izq = 320;
	ar = 70;
	der = 470;
	ab = 230;
	for (i = 0; i < 100; i++) {
		rectangle (izq, ar, der, ab);
		izq++;
		ar++;
		der--;
		ab--;
	}
	
	setcolor(14);
	izq = 165;
	ar = 240;
	der = 310;
	ab = 400;
	for (i = 0; i < 100; i++) {
		rectangle (izq, ar, der, ab);
		izq++;
		ar++;
		der--;
		ab--;
	}
	
	setcolor(2);
	izq = 320;
	ar = 240;
	der = 470;
	ab = 400;
	for (i = 0; i < 100; i++) {
		rectangle (izq, ar, der, ab);
		izq++;
		ar++;
		der--;
		ab--;
	}
	
	gotoxy(27,10);
	printf("TRIVIAL");
	gotoxy(47,10);
	printf("TRIVIAL");
	gotoxy(27,21);
	printf("TRIVIAL");
	gotoxy(47,21);
	printf("TRIVIAL");

	getch();
	closegraph();
}

void error(int err) {
	clrscr();
	/* Requiere auto detección */
	int gdriver = DETECT, gmode, errorcode;

	/* Inicializa las variables locales y los graficas */
	initgraph(&gdriver, &gmode, "t:\\bgi");

	/* Lee el resultado de la inicialización */
	errorcode = graphresult();
	if (errorcode != grOk) { /* Si ocurre algún error */
		printf("Error grafico: %s \n", grapherrormsg(errorcode));
		printf("Presionar una tecla para salir:");
		getch();
		exit(1); /* Codigo de error */
	}


	setbkcolor(4);
	gotoxy(35,15);
	printf("ERROR");
	switch(err) {
		case 1:
			gotoxy(15,16);
			printf("Debe iniciar sesion o registrarse antes de poder jugar");
		break;

		case 2:
			gotoxy(27,16);
			printf("Jugador ya registrado");
		break;

		case 3:
			gotoxy(28,16);
			printf("Usuario incorrecto");
		break;
		
		case 4:
			gotoxy(27,16);
			printf("Contrasena incorrecta");
		break;
		
		case 5:
			gotoxy(28,16);
			printf("Pregunta existente");
		break;
		
		case 6:
			gotoxy(20,16);
			printf("No tiene los permisos necesarios");
		break;
	}
	getch();
	closegraph();
}

void guardarpartida() {
	clrscr();
	int sum;
	
	fseek(l,0,0);
	while (!feof(l)) {
		fread(&part, sizeof(part),1,l);
	}
	
	sum = part.id;
	
	if(feof(l)) {
		part.id = sum + 1;
		strcpy(part.nick, usuario);
		part.punt = aciertos;
		fwrite(&part, sizeof(part),1,l);
	}
}

void juego() {
	clrscr();
	srand(time(0));
	int max = 0;
	int pos[4];
	int numrepe;
	int correcta;
	int resp;
	int pregrepe;
	int orden[10];
	aciertos = 0;
	fallos = 0;
	
	rewind(p);
	preg.id = NULL;
	while (!feof(p)) {
		max = preg.id;
		fread(&preg, sizeof(preg),1,p);
	}

	for (i = 0; i < 10; i++) {
		clrscr();
		do {
			pregrepe = 0;
			orden[i] = (rand() % max) + 1;
			if (i == 1) {
				if (orden[1] == orden[0]) {
					pregrepe = 1;
				}
			} else if (i == 2) {
				if (orden[2] == orden[0]) {
					pregrepe = 1;
				}
				if (orden[2] == orden[1]) {
					pregrepe = 1;
				}
			} else if (i == 3) {
				if (orden[3] == orden[0]) {
					pregrepe = 1;
				}
				if (orden[3] == orden[1]) {
					pregrepe = 1;
				}
				if (orden[3] == orden[2]) {
					pregrepe = 1;
				}
			} else if (i == 4) {
				if (orden[4] == orden[0]) {
					pregrepe = 1;
				}
				if (orden[4] == orden[1]) {
					pregrepe = 1;
				}
				if (orden[4] == orden[2]) {
					pregrepe = 1;
				}
				if (orden[4] == orden[3]) {
					pregrepe = 1;
				}
			} else if (i == 5) {
				if (orden[5] == orden[0]) {
					pregrepe = 1;
				}
				if (orden[5] == orden[1]) {
					pregrepe = 1;
				}
				if (orden[5] == orden[2]) {
					pregrepe = 1;
				}
				if (orden[5] == orden[3]) {
					pregrepe = 1;
				}
				if (orden[5] == orden[4]) {
					pregrepe = 1;
				}
			} else if (i == 6) {
				if (orden[6] == orden[0]) {
					pregrepe = 1;
				}
				if (orden[6] == orden[1]) {
					pregrepe = 1;
				}
				if (orden[6] == orden[2]) {
					pregrepe = 1;
				}
				if (orden[6] == orden[3]) {
					pregrepe = 1;
				}
				if (orden[6] == orden[4]) {
					pregrepe = 1;
				}
				if (orden[6] == orden[5]) {
					pregrepe = 1;
				}
			} else if (i == 7) {
				if (orden[7] == orden[0]) {
					pregrepe = 1;
				}
				if (orden[7] == orden[1]) {
					pregrepe = 1;
				}
				if (orden[7] == orden[2]) {
					pregrepe = 1;
				}
				if (orden[7] == orden[3]) {
					pregrepe = 1;
				}
				if (orden[7] == orden[4]) {
					pregrepe = 1;
				}
				if (orden[7] == orden[5]) {
					pregrepe = 1;
				}
				if (orden[7] == orden[6]) {
					pregrepe = 1;
				}
			} else if (i == 8) {
				if (orden[8] == orden[0]) {
					pregrepe = 1;
				}
				if (orden[8] == orden[1]) {
					pregrepe = 1;
				}
				if (orden[8] == orden[2]) {
					pregrepe = 1;
				}
				if (orden[8] == orden[3]) {
					pregrepe = 1;
				}
				if (orden[8] == orden[4]) {
					pregrepe = 1;
				}
				if (orden[8] == orden[5]) {
					pregrepe = 1;
				}
				if (orden[8] == orden[6]) {
					pregrepe = 1;
				}
				if (orden[8] == orden[7]) {
					pregrepe = 1;
				}
			} else if (i == 9) {
				if (orden[9] == orden[0]) {
					pregrepe = 1;
				}
				if (orden[9] == orden[1]) {
					pregrepe = 1;
				}
				if (orden[9] == orden[2]) {
					pregrepe = 1;
				}
				if (orden[9] == orden[3]) {
					pregrepe = 1;
				}
				if (orden[9] == orden[4]) {
					pregrepe = 1;
				}
				if (orden[9] == orden[5]) {
					pregrepe = 1;
				}
				if (orden[9] == orden[6]) {
					pregrepe = 1;
				}
				if (orden[9] == orden[7]) {
					pregrepe = 1;
				}
				if (orden[9] == orden[8]) {
					pregrepe = 1;
				}
			}
		} while(pregrepe == 1);
		
		rewind(p);
		preg.id = NULL;
		while (!feof(p)) {
			if (preg.id == orden[i]) {
				printf("Pregunta: %s \n\n", preg.pregunta);
		
				for (j = 0; j < 4; j++) {
					do {
						numrepe = 0;
						pos[j] = (rand() % 4) + 1;
						if (j == 1) {
							if (pos[1] == pos[0]) {
								numrepe = 1;
							}
						} else if (j == 2) {
							if (pos[2] == pos[0]) {
								numrepe = 1;
							}
							if (pos[2] == pos[1]) {
								numrepe = 1;
							}
						} else if (j == 3) {
							if (pos[3] == pos[0]) {
								numrepe = 1;
							}
							if (pos[3] == pos[1]) {
								numrepe = 1;
							}
							if (pos[3] == pos[2]) {
								numrepe = 1;
							}
						}
					} while(numrepe == 1);
				}
				
				for (k = 0; k < 4; k++) {
					printf("%d - ", (k+1));
					if (pos[k] == 1) {
						printf("%s", preg.correcta);
						correcta = (k+1);
					} else if (pos[k] == 2) {
						printf("%s", preg.falsa1);
					} else if (pos[k] == 3) {
						printf("%s", preg.falsa2);
					} else if (pos[k] == 4) {
						printf("%s", preg.falsa3);
					}
					printf("\n");
				}
				
				do {
					fflush(stdin);
					scanf("%d", &resp);
				} while(resp < 1 || resp > 4);
		
				if (resp == correcta) {
					aciertos++;
				} else {
					fallos++;
				}
			}
			fread(&preg, sizeof(preg),1,p);
		}
	}
	
	clrscr();
	printf("Aciertos: %d \n", aciertos);
	printf("Fallos: %d \n", fallos);
	getch();
	guardarpartida();	
}

void leaderboard() {
	clrscr();
	int max;
	int aux[10];
	
	for (i = 0; i < 10; i++) {
		printf("%d - ", (i+1));
		max = -1;
		rewind(l);
		part.punt = 0;
		while (!feof(l)) {
			if (part.punt > max) {
				if (part.id != aux[0] && part.id != aux[1] && part.id != aux[2] && part.id != aux[2] && part.id != aux[3] && part.id != aux[4] && part.id != aux[5] && part.id != aux[6] && part.id != aux[7] && part.id != aux[8] && part.id != aux[9]) {
					max = part.punt;
					aux[i] = part.id;
				}
			}
			fread(&part, sizeof(part),1,l);
		}
		
		rewind(l);
		part.punt = NULL;
		while (!feof(l)) {
			if (part.punt == max && part.id == aux[i]) {
				printf("%s - %d \n\n", part.nick, part.punt);
			}
			fread(&part, sizeof(part),1,l);
		}
	}
	getch();
}

void inicio() {
	clrscr();
	fseek(f,0,0);
	printf("Usuario:");
	fflush(stdin);
	gets(cadena);
	while((strcmp(jug.nick, cadena) != 0) && (!feof(f))) {
		fread(&jug, sizeof(jug),1,f);
	}
	if(!feof(f)) {
		printf("Contrasena:");
		fflush(stdin);
		gets(cadena);
		if (strcmp(jug.pass, cadena) == 0) {
			stpcpy(usuario, jug.nick);
			administrador = jug.admin;
			acceso = 1;
		} else {
			error(4);
		}
	} else {
		error(3);
	}
}

void registro() {
	clrscr();
	fseek(f,0,0);
	printf("Usuario:");
	fflush(stdin);
	gets(cadena);
	while((strcmp(jug.nick, cadena) != 0) && (!feof(f))) {
		fread(&jug, sizeof(jug),1,f);
	}

	if(feof(f)) {
		strcpy(jug.nick, cadena);
		printf("Email: ");
		fflush(stdin);
		gets(jug.mail);
		printf("Contrasena: ");
		fflush(stdin);
		gets(jug.pass);
		printf("Direccion: ");
		fflush(stdin);
		gets(jug.dir);
		printf("Telefono: ");
		fflush(stdin);
		gets(jug.tlf);
		printf("Edad: ");
		fflush(stdin);
		scanf("%d", &jug.edad);
		
		if ((strcmp(jug.nick, "admin") == 0)) {
			jug.admin = 1;
		} else {
			jug.admin = 0;
		}
		
		fwrite(&jug, sizeof(jug),1,f);
		
		stpcpy(usuario, jug.nick);
		administrador = jug.admin;
		acceso = 1;
	} else {
		error(2);
	}
}

void acceder() {
	int inic;
	
	do {
		clrscr();
		printf("1 - Iniciar Sesion \n");
		printf("2 - Registrarse \n");
		printf("3 - Volver \n");
		fflush(stdin);
		scanf("%d", &inic);
	
		switch(inic) {
			case 1:
				inicio();
			break;

			case 2:
				registro();
			break;
		}
	} while(inic != 3);
}

void agregar() {
	clrscr();
	fseek(p,0,0);
	printf("ID:");
	fflush(stdin);
	scanf("%d", &identificador);
	while ((preg.id != identificador) && (!feof(p))) {
		fread(&preg, sizeof(preg),1,p);
	}

	if(feof(p)) {
		preg.id = identificador;
		printf("Pregunta: ");
		fflush(stdin);
		gets(preg.pregunta);
		printf("Respuesta Correcta: ");
		fflush(stdin);
		gets(preg.correcta);
		printf("Respuesta Falsa 1: ");
		fflush(stdin);
		gets(preg.falsa1);
		printf("Respuesta Falsa 2: ");
		fflush(stdin);
		gets(preg.falsa2);
		printf("Respuesta Falsa 3: ");
		fflush(stdin);
		gets(preg.falsa3);
		fwrite(&preg, sizeof(preg),1,p);
		
		acceso = 1;
	} else {
		error(5);
	}
}

void verpreg() {
	rewind(p);
	clrscr();
	preg.id = NULL;

	while (!feof(p)) {
		if (preg.id != NULL) {
			printf("ID: %d \n Pregunta: %s \n Respuesta Correcta: %s \n Respuesta Falsa 1: %s \n Respuesta Falsa 2: %s \n Respuesta Falsa 3: %s \n\n\n", preg.id, preg.pregunta, preg.correcta, preg.falsa1, preg.falsa2, preg.falsa3);
		}
		fread(&preg, sizeof(preg),1,p);
	}
	getch();
}

void verus() {
	rewind(f);
	clrscr();
	strcpy(jug.nick,"");

	while (!feof(f)) {
		if (strcmp(jug.nick, "") != 0) {
			printf("Nombre: %s \n Email: %s \n Direccion: %s \n Telefono: %s \n Edad: %d \n Admin: %d \n\n\n", jug.nick, jug.mail, jug.dir, jug.tlf, jug.edad, jug.admin);
		}
		fread(&jug, sizeof(jug),1,f);
	}
	getch();
}

void verpart() {
	rewind(l);
	clrscr();
	part.id = NULL;

	while (!feof(l)) {
		if (part.id != NULL) {
			printf("ID: %d \n Jugador: %s \n Puntuacion: %d \n\n\n",part.id, part.nick, part.punt);
		}
		fread(&part, sizeof(part),1,l);
	}
	getch();
}

void administrar() {
	int ad;
	
	do {
		clrscr();
		printf("1 - Agregar Pregunta \n");
		printf("2 - Ver Preguntas \n");
		printf("3 - Ver Usuarios \n");
		printf("4 - Ver Partidas \n");
		printf("5 - Volver \n");
		fflush(stdin);
		scanf("%d", &ad);
	
		switch(ad) {
			case 1:
				agregar();
			break;

			case 2:
				verpreg();
			break;
			
			case 3:
				verus();
			break;
			
			case 4:
				verpart();
			break;
		}
	} while(ad != 5);
}

void salida() {
	/* Requiere auto detección */
	int gdriver = DETECT, gmode, errorcode;
	int midx, midy;
	int radius = 110;
	int izq, ar, der, ab;
	int i;

	/* Inicializa las variables locales y los graficas */
	initgraph(&gdriver, &gmode, "t:\\bgi");

	/* Lee el resultado de la inicialización */
	errorcode = graphresult();
	if (errorcode != grOk) { /* Si ocurre algún error */
		printf("Error grafico: %s \n", grapherrormsg(errorcode));
		printf("Presionar una tecla para salir:");
		getch();
		exit(1); /* Codigo de error */
	}
	
	setcolor(getmaxcolor());
	midx = getmaxx()/2;
	midy = getmaxy()/2;
	fillellipse (midx, midy, radius, radius);
	
	setcolor(5);
	izq = 100;
	ar = 25;
	der = 550;
	ab = 450;
	for (i = 0; i < 100; i++) {
		rectangle (izq, ar, der, ab);
		izq++;
		ar++;
		der--;
		ab--;
	}
	
	gotoxy(32,15);
	printf("Gracias por jugar \n");
	gotoxy(29,16);
	printf("Vuelva cuando quiera :) \n");

	getch();
	closegraph();
}

void menu(int *opcion) {
	clrscr();
	int op;
	
	printf("    TRIVIAL \n");
	printf("=============== \n");
	printf("1 - JUGAR \n");
	printf("2 - LEADERBOARD \n");
	printf("3 - ACCEDER \n");
	printf("4 - ADMINISTRAR \n");
	printf("5 - SALIR \n");
	fflush(stdin);
	scanf("%d", &op);
	
	*opcion = op;
	
	switch(op) {
		case 1:
			if (acceso == 1) {
				juego();
			} else {
				error(1);
			}
			
		break;

		case 2:
			leaderboard();
		break;

		case 3:
			acceder();
		break;
		
		case 4:
			if (administrador == 1) {
				administrar();
			} else {
				error(6);
			}
		break;
		
		case 5:
			salida();
		break;
	}
}

void main() {
	clrscr();
	srand(time(0));
	int opcion;
	
	f=fopen("usuarios.dat","a+b");
	l=fopen("partidas.dat","a+b");
	p=fopen("preguntas.dat","a+b");
	portada();
	do {
		menu(&opcion);
	} while(opcion != 5);
}