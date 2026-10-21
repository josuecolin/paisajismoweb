from fastapi import FastAPI
from pydantic import BaseModel, Field
from pathlib import Path

import joblib
import json
import pandas as pd


app = FastAPI(
    title="Garden Valle ML API",
    description="API local para clasificación de perfiles mediante Machine Learning",
    version="1.0"
)


BASE_DIR = Path(__file__).resolve().parent

MODEL_PATH = BASE_DIR / "modelo_kmeans.pkl"
SCALER_PATH = BASE_DIR / "scaler.pkl"
PERFILES_PATH = BASE_DIR / "perfiles.json"
METADATA_PATH = BASE_DIR / "metadata_modelo.json"


COLUMNAS = [
    "p1",
    "p2",
    "p3",
    "p4",
    "p5",
    "p6",
    "p7",
    "p8",
    "p9",
    "p10",
    "p11",
    "p12",
    "p13",
    "p14",
    "p15"
]


class RespuestasCuestionario(BaseModel):

    p1: int = Field(..., ge=1, le=5)
    p2: int = Field(..., ge=1, le=5)
    p3: int = Field(..., ge=1, le=5)
    p4: int = Field(..., ge=1, le=5)
    p5: int = Field(..., ge=1, le=5)

    p6: int = Field(..., ge=1, le=5)
    p7: int = Field(..., ge=1, le=5)
    p8: int = Field(..., ge=1, le=5)
    p9: int = Field(..., ge=1, le=5)
    p10: int = Field(..., ge=1, le=5)

    p11: int = Field(..., ge=1, le=5)
    p12: int = Field(..., ge=1, le=5)
    p13: int = Field(..., ge=1, le=5)
    p14: int = Field(..., ge=1, le=5)
    p15: int = Field(..., ge=1, le=5)


def cargar_perfiles():

    if not PERFILES_PATH.exists():
        return {}

    with open(
        PERFILES_PATH,
        "r",
        encoding="utf-8"
    ) as archivo:

        return json.load(archivo)


@app.get("/")
def inicio():

    return {
        "estado": "correcto",
        "mensaje": "Garden Valle ML API funcionando"
    }


@app.get("/estado-modelo")
def estado_modelo():

    disponible = (
        MODEL_PATH.exists()
        and SCALER_PATH.exists()
    )

    return {
        "modelo_disponible": disponible
    }


@app.post("/clasificar")
def clasificar(
    respuestas: RespuestasCuestionario
):

    # Todavía no existe un modelo entrenado
    if not MODEL_PATH.exists() or not SCALER_PATH.exists():

        return {
            "ok": True,
            "modelo_disponible": False,
            "mensaje": "Las respuestas fueron recibidas correctamente, pero el modelo todavía no ha sido entrenado."
        }


    # Cargar modelo
    modelo = joblib.load(
        MODEL_PATH
    )

    scaler = joblib.load(
        SCALER_PATH
    )


    # Convertir respuestas a DataFrame
    datos = respuestas.model_dump()

    usuario = pd.DataFrame(
        [datos],
        columns=COLUMNAS
    )


    # Escalar igual que durante entrenamiento
    usuario_escalado = scaler.transform(
        usuario
    )


    # Clasificar
    cluster = int(
        modelo.predict(
            usuario_escalado
        )[0]
    )


    # Obtener nombre del perfil
    perfiles = cargar_perfiles()

    perfil = perfiles.get(
        str(cluster),
        f"Cluster {cluster}"
    )


    return {
        "ok": True,
        "modelo_disponible": True,
        "cluster": cluster,
        "perfil": perfil
    }